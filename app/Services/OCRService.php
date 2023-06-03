<?php

namespace App\Services;

use App\Models\ConstructorModel;
use App\Models\DriverModel;
use App\Models\RaceResultModel;
use App\Models\TeamModel;
use App\Models\TrackModel;
use App\Utility_Collection;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class OCRService
{
    public function __construct(protected RaceService $raceService)
    {

    }

    public function getTextFromImage(Request $request, $img){
        /**
         * todo: check if implementation is possible
         */
        $base64 = base64_encode($img);
        $client = new Client();
        $base64 = "data:image/png;base64," . $base64;

        $body = array(
            "base64" => $base64,
            "tool" => 'imagetotext'
        );

        $request = new GuzzleRequest(
            "POST",
            "https://www.imagetotext.info/image-to-text",
            [
                RequestOptions::BODY, $body,
                RequestOptions::HEADERS => getallheaders()
            ]
        );
        $response = $client->send($request);
    }

    public function getRaceData(Request $request)
    {
        $ocrData = $this->clearText($request->post());
        $driversOCR = $ocrData['drivers'];
        $teamsOCR = $ocrData['teams'];
        $gridPosOCR = $ocrData['gridPos'];
        //$qualiPosOCR = $this->clearText($request->get('qualiPos'));
        $personalBestLaps = $ocrData['personalBestLaps'];
        //$pitStops = $this->clearText($request->get('pitStops'));
        //$raceTime = $this->clearText($request->get('raceTime'));
        $timePens = $ocrData['timePens'];

        $drivers = $this->getDrivers($driversOCR);
        $teams = $this->getTeams($teamsOCR);

        $this->assertCount((int)$request->get('driverCount'), [
            'drivers' => $drivers,
            'teams' => $teams,
            'gridPos' => $gridPosOCR,
            'personalBestLaps' => $personalBestLaps,
            'timePens' => $timePens
        ]);

        $race = $this->raceService->getRaceByTrack($request->get('track'));
        $raceResults = new Utility_Collection();

        foreach ($drivers as $key => $driver) {
            $resultData = array(
                RaceResultModel::LEAGUE_ID => 1,
                RaceResultModel::RACE_ID => $race->id,
                RaceResultModel::DRIVER_ID => $driver->id,
                RaceResultModel::CONSTRUCTOR_ID => $teams[$key]->id,
                RaceResultModel::POS_QUALI => (int)$gridPosOCR[$key],
                RaceResultModel::POS_GRID => (int)$gridPosOCR[$key],
                RaceResultModel::POS_RACE => (int)$key+1,
                RaceResultModel::PERSONAL_BEST_LAP => $personalBestLaps[$key],
                RaceResultModel::TIME_PEN => (int)$timePens[$key],
                RaceResultModel::FASTEST_LAP => 0,
                RaceResultModel::DNF => 0,
                RaceResultModel::DSQ => 0
            );

            $raceResult = new RaceResultModel($resultData);
            $raceResult->save();
            $raceResults->push($raceResult);
        }
        return $raceResults;
    }

    private function getTimePens(array $timePens, array $raceTimes)
    {
        foreach ($timePens as $key => $timePen) {
            if ($timePen === $raceTimes[$key]) {
                $timePens[$key] = "";
            }
        }
        return $timePens;
    }

    private function assertCount($driverCount, array $data)
    {
        foreach ($data as $key => $row) {
            $count = count($row);
            if ($driverCount !== $count) {
                throw new \Exception($key . " DATA_COUNT_DOESNT_MATCH_EXPECTED_COUNT " . " EXPECTED_COUNT_IS " . $driverCount . " DATA_COUNT_IS " . $count);
            }
        }
    }

    private function clearText($data)
    {
        foreach ($data as $dataType => $column) {
            $data[$dataType] = explode("\n", $column);

            foreach ($data[$dataType] as $key => $str) {
                if (str_contains($str, "|")) {
                    $data[$dataType][$key] = str_replace("|", "", $str);
                }
                if (str_contains($str, "I ")) {
                    $data[$dataType][$key] = str_replace("I ", "", $str);
                }

                $pattern = '/\s*/m';
                $replace = '';
                $data[$dataType][$key] = preg_replace($pattern, $replace, $data[$dataType][$key]);

                if (
                    str_contains($str, "FORMULA 1") |
                    str_contains($str, "POS. FAHRER") |
                    str_contains($str, "TEAM") |
                    str_contains($str, "GRID") |
                    str_contains($str, "STOPPS BESTE") |
                    str_contains($str, "ZEIT")
                ) {
                    unset($data[$dataType][$key]);
                }

                if ($dataType === 'timePens') {
                    if (str_contains($data[$dataType][$key], "+") && str_contains($data[$dataType][$key], "sek.")) {
                        $start = strpos($data[$dataType][$key], "+") + 1;
                        $end = strpos($data[$dataType][$key], "sek.") - 4;
                        $data[$dataType][$key] = substr($data[$dataType][$key], $start, $end);
                    } elseif (
                        str_contains($data[$dataType][$key], "Runde") |
                        str_contains($data[$dataType][$key], "DNF") |
                        str_contains($data[$dataType][$key], "DSQ")
                    ) {
                        continue;
                    } else {
                        $data[$dataType][$key] = null;
                    }
                }

            }
        }
        return $data;
    }

    public function getRaceTrack($text)
    {
        $gp = trim(str_replace("GRAND PRIX VON", "", $text));
        $gp = str_replace("-", " ", $gp);
        $gp = explode(" ", $gp);
        foreach ($gp as $str) {

            if (empty($str)) {
                continue;
            }

            $track = TrackModel::query()->where(TrackModel::COUNTRY, "LIKE", "%".$str."%")->first();

            if (!$track){
                $track = TrackModel::query()->where(TrackModel::CITY, "LIKE", "%".$str."%")->first();
                if (!$track) {
                    $str = $str. " ". next($gp);
                    $track = TrackModel::query()->where(TrackModel::CITY, "LIKE", "%".$str."%")->first();
                }
            }

            if ($track->first()) {
                return $track;
            }
        }

        throw new NotFoundHttpException("TRACK" . $str ."NOT FOUND");
    }

    public function getTeams($teamsOCR)
    {
        $constructors = new Utility_Collection();

        foreach ($teamsOCR as $team) {
            $team = $this->rmvWhiteSpaces($team);
            $constructor = ConstructorModel::query()->where(ConstructorModel::NAME_OCR, "LIKE", '%' .$team. '%')->first();

            if ($constructor) {
                $constructors->push($constructor);
            }
        }

        return $constructors;
    }

    public function getDrivers($driversOCR)
    {
        $drivers = new Utility_Collection();

        foreach ($driversOCR as $driverOCR) {
            $str = substr($driverOCR, 0, strlen($driverOCR)/3*2);
            $driver = DriverModel::query()->where(DriverModel::NAME_INGAME, "LIKE", $str. '%')->first();
            if ($driver instanceof DriverModel) {
                $drivers->push($driver);
            } else {
                Log::channel('amal')->error('DRIVER NOT FOUND', [
                    $driverOCR
                ]);
            }
        }
        return $drivers;
    }

    private function rmvWhiteSpaces($text)
    {
        $pattern = '/\s*/m';
        $replace = '';
        return preg_replace( $pattern, $replace, $text);
    }
}
