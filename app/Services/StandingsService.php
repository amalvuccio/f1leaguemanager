<?php

namespace App\Services;

class StandingsService
{
    public function __construct()
    {

    }
    public function getTeamStandings()
    {
        $baseImgUrl = "../resources/documents/standings/teams/Base.jpg";

        $base = imagecreatefromjpeg($baseImgUrl);
        imagepng($base, "../resources/documents/standings/TeamStandings.png");

        $coordinatesPos = array(
            1 => 221,
            2 => 315,
            3 => 409,
            4 => 503,
            5 => 597,
            6 => 691,
            7 => 785,
            8 => 879,
            9 => 973,
            10 => 1067
        );

        $standings = array(
            [
                "name" => "RedBull",
                "pos" => 1,
                "points" => 519
            ],
            [
                "name" => "McLaren",
                "pos" => 2,
                "points" => 443
            ],
            [
                "name" => "Mercedes",
                "pos" => 4,
                "points" => 389
            ],
            [
                "name" => "Alpine",
                "pos" => 3,
                "points" => 389
            ],
            [
                "name" => "AstonMartin",
                "pos" => 5,
                "points" => 311
            ],
            [
                "name" => "Williams",
                "pos" => 6,
                "points" => 300
            ],
            [
                "name" => "Ferrari",
                "pos" => 7,
                "points" => 260
            ],
            [
                "name" => "Haas",
                "pos" => 8,
                "points" => 240
            ],
            [
                "name" => "AlphaTauri",
                "pos" => 9,
                "points" => 230
            ],
            [
                "name" => "AlfaRomeo",
                "pos" => 10,
                "points" => 190
            ],
        );

        foreach ($standings as $team) {
            $teamBase = @imagecreatefrompng("../resources/documents/standings/teams/" . $team['name'] . ".png");
            $pointsBox = @imagecreatefrompng("../resources/documents/standings/PointsBox.png");
            imagecopymerge($base, $teamBase, 42,$coordinatesPos[$team['pos']],0,0, 651, 83,100);
            imagecopymerge($base, $pointsBox, 651 + 52,$coordinatesPos[$team['pos']],0,0, 221, 83,100);
            $tb = imagettfbbox(47, 0, "../resources/fonts/Formula1-Black.ttf", $team['points']);
            $x = ceil((221 - $tb[2]) / 2); // lower left X coordinate for text
            imagettftext($base, 47, 0, $x + 651 + 52, $coordinatesPos[$team['pos']]+68, $this->getNumberTextColor($base, $team['pos']) , "../resources/fonts/Formula1-Black.ttf", $team['points']);
        }
        imagepng($base, "../resources/documents/standings/TeamStandings.png");
    }

    public function getDriverStandings()
    {
        $coordinatesPos = array(
            1 => 221,
            2 => 315,
            3 => 409,
            4 => 503,
            5 => 597,
            6 => 691,
            7 => 785,
            8 => 879,
            9 => 973,
            10 => 1067
        );

        $standings = array(
            1 => [
                [
                    "name" => "Clemente1804",
                    "team" => "RedBull",
                    "pos" => 2,
                    "points" => 259
                ],
                [
                    "name" => "Mlody_35",
                    "team" => "AlphaTauri",
                    "pos" => 4,
                    "points" => 224
                ],
                [
                    "name" => "Basti1997-TJ",
                    "team" => "RedBull",
                    "pos" => 1,
                    "points" => 260
                ],
                [
                    "name" => "Ronlu222",
                    "team" => "McLaren",
                    "pos" => 3,
                    "points" => 236
                ],
                [
                    "name" => "SBBela",
                    "team" => "McLaren",
                    "pos" => 6,
                    "points" => 196
                ],
                [
                    "name" => "Janosch077",
                    "team" => "AstonMartin",
                    "pos" => 10,
                    "points" => 171
                ],
                [
                    "name" => "Maxinator0904",
                    "team" => "Mercedes",
                    "pos" => 8,
                    "points" => 182
                ],
                [
                    "name" => "Dezin",
                    "team" => "Alpine",
                    "pos" => 5,
                    "points" => 211
                ],
                [
                    "name" => "LSjOM7",
                    "team" => "Mercedes",
                    "pos" => 7,
                    "points" => 185
                ],
                [
                    "name" => "Tizian",
                    "team" => "Alpine",
                    "pos" => 9,
                    "points" => 171
                ],
            ],
            2 => [
                [
                    "name" => "xbatchris",
                    "team" => "Ferrari",
                    "pos" => 3,
                    "points" => 127
                ],
                [
                    "name" => "ObNöKhEsLeZ",
                    "team" => "Williams",
                    "pos" => 1,
                    "points" => 146
                ],
                [
                    "name" => "ToniTempo",
                    "team" => "AlfaRomeo",
                    "pos" => 4,
                    "points" => 103
                ],
                [
                    "name" => "Nobbler1975",
                    "team" => "AstonMartin",
                    "pos" => 2,
                    "points" => 137
                ],
                [
                    "name" => "prefy",
                    "team" => "Haas",
                    "pos" => 5,
                    "points" => 89
                ],
                [
                    "name" => "HamburgerJung",
                    "team" => "AlphaTauri",
                    "pos" => 10,
                    "points" => 61
                ],
                [
                    "name" => "DMK160988",
                    "team" => "Haas",
                    "pos" => 6,
                    "points" => 78
                ],
                [
                    "name" => "Mathador1887",
                    "team" => "Ferrari",
                    "pos" => 7,
                    "points" => 74
                ],
                [
                    "name" => "willi87_94",
                    "team" => "Williams",
                    "pos" => 8,
                    "points" => 65
                ],
                [
                    "name" => "Julianus33",
                    "team" => "AlfaRomeo",
                    "pos" => 9,
                    "points" => 62
                ]
            ],
            3 => [
                [
                    "name" => "ag_323_ha",
                    "team" => "EF",
                    "pos" => 1,
                    "points" => 42
                ],
                [
                    "name" => "xPhilippFCB",
                    "team" => "EF",
                    "pos" => 4,
                    "points" => 25
                ],
                [
                    "name" => "SDC_Beesel",
                    "team" => "EF",
                    "pos" => 3,
                    "points" => 31
                ],
                [
                    "name" => "aka_scharfi_82",
                    "team" => "EF",
                    "pos" => 2,
                    "points" => 41
                ],
                [
                    "name" => "Ramrod",
                    "team" => "EF",
                    "pos" => 6,
                    "points" => 5
                ],
                [
                    "name" => "Riccihsv201",
                    "team" => "EF",
                    "pos" => 7,
                    "points" => 5
                ],
                [
                    "name" => "Dschoakim",
                    "team" => "EF",
                    "pos" => 8,
                    "points" => 0
                ],
                [
                    "name" => "Bayernfreaky",
                    "team" => "EF",
                    "pos" => 5,
                    "points" => 18
                ]
            ]
        );

        foreach ($standings as $pageNum => $page) {
            $baseImgUrl = "../resources/documents/standings/drivers/Base_page". $pageNum .".png";
            $base = @imagecreatefrompng($baseImgUrl);
            foreach ($page as $driver) {
                $driverBase = @imagecreatefrompng("../resources/documents/standings/drivers/" . $driver['team'] . ".png");
                if (isset($driver['change'])) {
                    switch ($driver['change']){
                        case "up":
                            $pointsBox = @imagecreatefrompng("../resources/documents/standings/Base_up.png");
                            break;
                        case "down":
                            $pointsBox = @imagecreatefrompng("../resources/documents/standings/Base_down.png");
                            break;
                    }
                } else {
                    $pointsBox = @imagecreatefrompng("../resources/documents/standings/PointsBox.png");
                }


                imagecopymerge($base, $driverBase, 42,$coordinatesPos[$driver['pos']],0,0, 651, 83,100);
                imagettftext($base, 30, 0, 280, $coordinatesPos[$driver['pos']]+57, $this->getNameTextColor($base, $driver['team']) , "../resources/fonts/Formula1-Black.ttf", $driver['name']);


                imagecopymerge($base, $pointsBox, 651 + 52,$coordinatesPos[$driver['pos']],0,0, 221, 83,100);
                $tb = imagettfbbox(47, 0, "../resources/fonts/Formula1-Black.ttf", $driver['points']);
                $x = ceil((221 - $tb[2]) / 2); // lower left X coordinate for text
                imagettftext($base, 47, 0, $x + 651 + 52, $coordinatesPos[$driver['pos']]+68, $this->getNumberTextColor($base, $driver['pos']) , "../resources/fonts/Formula1-Black.ttf", $driver['points']);
            }
            imagepng($base, "../resources/documents/standings/DriverStandings ". $pageNum .".png");
        }
        //$outputImage = imagecreatefrompng("../resources/documents/standings/test.png");

    }

    private function getNameTextColor($img, $teamName): false|int
    {
        if ($teamName == "Ferrari" || $teamName == "Haas"){
            return imagecolorallocate($img, 0, 0, 0);
        }
        return imagecolorallocate($img, 255, 255, 255);
    }
    private function getNumberTextColor($img, $pos): false|int
    {
        /*
        if ($pos === 1) {
            return imagecolorallocate($img, 255, 177, 43);
        } else if ($pos === 2) {
            return imagecolorallocate($img, 138, 138, 138);
        } else if ($pos === 3) {
            return imagecolorallocate($img, 163, 97, 42);
        }
        */
        return imagecolorallocate($img, 255, 255, 255);
    }

    private function sort($array): int
    {
        $driverTable = -100;
        foreach ($array as $driver) {
            for ($i = 0; $i <= 10; $i++){
                if ($driver['points'] > $driverTable) {
                    $driverTable = $driver['points'];
                    $driver['pos'] = 1;
                } else {

                }
            }
        }
    }
}
