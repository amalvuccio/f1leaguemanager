<?php

namespace App\Services;

use App\Models\TeamModel;
use Illuminate\Tests\Integration\Database\EloquentHasManyThroughTest\Team;
use Phalcon\Collection;
use function PHPUnit\TestFixture\func;

class StartingGridService
{
    public function __construct(protected TeamService $teamService)
    {

    }
    public function getStartingGrid()
    {
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
            imagettftext($base, 27, 0, 486, $coordinatesPos[$pos+1]+48, $this->getNameTextColor($base, $constructor) , "../resources/fonts/Formula1-Black.ttf", $team->drivers[0]->name_discord);
            imagecopymerge($base, $teamBase, 1280,$coordinatesPos[$pos+1],0,0, 615, 66,100);
            imagettftext($base, 27, 0, 1310, $coordinatesPos[$pos+1]+48, $this->getNameTextColor($base, $constructor) , "../resources/fonts/Formula1-Black.ttf", $team->drivers[1]->name_discord);


        }
        imagepng($base, "../resources/documents/starting_grid/StartingGrid.png");




        return json_encode($this->teamService->listTeams(2));

    }

    private function getNameTextColor($img, $teamName): false|int
    {
        if ($teamName == "Ferrari" || $teamName == "Haas"){
            return imagecolorallocate($img, 0, 0, 0);
        }
        return imagecolorallocate($img, 255, 255, 255);
    }
}
