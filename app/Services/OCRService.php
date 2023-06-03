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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class OCRService
{
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
        $text = $request->post();
        $text['drivers'] = $this->clearText($text['drivers']);
        $text['teams'] = $this->clearText($text['teams']);
        $text['gridPos'] = $this->clearText($text['gridPos']);


        $drivers = $this->getDrivers($text['drivers']);

        $teams = $this->getTeams($text['teams']);
        $gridPos = $text['gridPos'];

        $raceResults = new Utility_Collection();

        foreach ($drivers as $key => $driver) {
            $resultData = array(
                RaceResultModel::LEAGUE_ID => 1,
                RaceResultModel::RACE_ID => 6,
                RaceResultModel::DRIVER_ID => $driver->id,
                RaceResultModel::CONSTRUCTOR_ID => $teams[$key]->id,
                RaceResultModel::POS_QUALI => 1,
                RaceResultModel::POS_GRID => $gridPos[$key],
                RaceResultModel::POS_RACE => $key+1,
                RaceResultModel::TIME_PEN => 0,
                RaceResultModel::FASTEST_LAP => 0,
                RaceResultModel::DNF => 0,
                RaceResultModel::DSQ => 0
            );

            $raceResult = new RaceResultModel($resultData);
            $raceResult->save();
        }

        /*
        foreach ($text as $key => $str) {
            if (str_contains($text[$key], "GRANDPRIXVON")) {
                //$raceTrack = $this->getRaceTrack($text[$key]);
                continue;
                //return $raceTrack;
            }

            if (is_numeric($str)) {
                var_dump($str);
                continue;
            }

            if (str_contains($str, ":")) {
                continue;
            }

            if (str_contains($str, "+")) {
                continue;
            }
        }
        */
    }

    private function clearText(string $text)
    {
        $text = explode("\n", $text);
        foreach ($text as $key => $str) {

            if (str_contains($str, "|")) {
                $text[$key] = str_replace("|", "", $str);
            }
            if (str_contains($str, "I ")) {
                $text[$key] = str_replace("I ", "", $str);
            }


            $pattern = '/\s*/m';
            $replace = '';
            $text[$key] = preg_replace( $pattern, $replace, $text[$key]);

            /*
            if (str_contains($str, "RonluZZZ")) {
                $text[$key] = "Ronlu222";
            }
            */

            if (
                str_contains($str, "FORMULA 1") |
                str_contains($str, "POS. FAHRER") |
                str_contains($str, "TEAM") |
                str_contains($str, "GRID") |
                str_contains($str, "STOPPS BESTE") |
                str_contains($str, "ZEIT")
            ) {
                unset($text[$key]);
            }
        }
        return $text;
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

        foreach ($driversOCR as $driver) {
            $str = substr($driver, 0, strlen($driver)/3*2);
            $driver = DriverModel::query()->where(DriverModel::NAME_INGAME, "LIKE", $str. '%')->first();
            if ($driver instanceof DriverModel) {
                $drivers->push($driver);
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
