<?php

namespace App\Services;

use App\Models\TeamModel;
use Illuminate\Tests\Integration\Database\EloquentHasManyThroughTest\Team;
use Phalcon\Collection;
use function PHPUnit\TestFixture\func;

class StartingGridService
{
    public function __construct(
        protected TeamService $teamService,
        protected TrackService $trackService,
        protected RaceService $raceService
    ) {

    }
    public function getStartingGrid()
    {
        return $this->getBaseGraphic();

        $baseImgUrl = "../resources/documents/starting_grid/Base.jpg";
        $base = imagecreatefromjpeg($baseImgUrl);
        imagepng($base, "../resources/documents/starting_grid/StartingGrid.png");

        $numberBaseImgUrl = "../resources/documents/starting_grid/NumberBase.png";
        $numberBaseImg = @imagecreatefrompng($numberBaseImgUrl);

        $coordinatesPos = array(
            1 => 32,
            2 => 131,
            3 => 230,
            4 => 329,
            5 => 428,
            6 => 527,
            7 => 626,
            8 => 725,
            9 => 824,
            10 => 923
        );

        $constructorList = [
            'RedBull',
            'Ferrari',
            'Mercedes',
            'Alpine',
            'McLaren',
            'AlfaRomeo',
            'AstonMartin',
            'Haas',
            'AlphaTauri',
            'Williams'
        ];


        foreach ($constructorList as $pos => $constructor) {
            $teamBase = @imagecreatefrompng("../resources/documents/starting_grid/teams/" . $constructor . ".png");
            imagecopymerge($base, $numberBaseImg, 303,$coordinatesPos[$pos+1],0,0, 615, 66,100);
            imagecopymerge($base, $numberBaseImg, 1127,$coordinatesPos[$pos+1],0,0, 615, 66,100);

            imagecopymerge($base, $teamBase, 456,$coordinatesPos[$pos+1],0,0, 615, 66,100);
            $team = $this->teamService->getTeamByConstructor($constructor, 2);

            $defaultSize = 28;
            $tb = imagettfbbox($defaultSize, 0, "../resources/fonts/Formula1-Black.ttf",  $team->drivers[0]->name_discord);

            for ($size = $defaultSize; ($tb[2] - $tb[0]) > 286; $size--) {
                $tb = imagettfbbox($size, 0, "../resources/fonts/Formula1-Black.ttf",  $team->drivers[0]->name_discord);
            }



            $x = ceil((286 - $tb[2]) / 2); // lower left X coordinate for text

            $heightText = $tb[1] - $tb[7];
            $freeSpace = 66 - $heightText;
            $y = ($freeSpace / 2);

            var_dump($y);


            if (str_contains($team->drivers[0]->name_discord, '_')) {
                $y = $y+5;
            }

            imagettftext($base, $size, 0, 490, $coordinatesPos[$pos+1]+66-$y, $this->getNameTextColor($base, $constructor) , "../resources/fonts/Formula1-Black.ttf", $team->drivers[0]->name_discord);
            $defaultSize = 28;
            $tb = imagettfbbox($defaultSize, 0, "../resources/fonts/Formula1-Black.ttf",  $team->drivers[1]->name_discord);

            for ($size = $defaultSize; ($tb[2] - $tb[0]) > 350; $size--) {
                $tb = imagettfbbox($size, 0, "../resources/fonts/Formula1-Black.ttf",  $team->drivers[1]->name_discord);
            }


            $heightText = $tb[1] - $tb[7];
            $freeSpace = 66 - $heightText;
            $y = ($freeSpace / 2);

            if (str_contains($team->drivers[1]->name_discord, '_')) {
                $y = $y+5;
            }

            imagecopymerge($base, $teamBase, 1280,$coordinatesPos[$pos+1],0,0, 615, 66,100);
            imagettftext($base, $size, 0, 1310, $coordinatesPos[$pos+1]+66-$y, $this->getNameTextColor($base, $constructor) , "../resources/fonts/Formula1-Black.ttf", $team->drivers[1]->name_discord);


        }
        imagepng($base, "../resources/documents/starting_grid/StartingGrid.png");




        return json_encode($this->teamService->listTeams(2));

    }

    private function getBaseGraphic()
    {
        $race = $this->raceService->getRaceByCalenderPos(2, 4);

        $baseImgUrl = "../resources/documents/starting_grid/Base.jpg";
        $base = imagecreatefromjpeg($baseImgUrl);
        imagepng($base, "../resources/documents/starting_grid/StartingGrid.png");
        imagettftext($base, 100, 0, 490, 500, 100 , "../resources/fonts/Formula1-Black.ttf",  $race->track->gp_name);

        imagepng($base, "../resources/documents/starting_grid/StartingGrid.png");



        var_dump($race->track->gp_name);
        return $race->track->gp_name;
    }

    private function getNameTextColor($img, $teamName): false|int
    {
        if ($teamName == "Ferrari" || $teamName == "Haas"){
            return imagecolorallocate($img, 0, 0, 0);
        }
        return imagecolorallocate($img, 255, 255, 255);
    }
}
