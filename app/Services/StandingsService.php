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
                "name" => "AlfaRomeo",
                "pos" => 9,
                "points" => 108
            ],
            [
                "name" => "AlphaTauri",
                "pos" => 10,
                "points" => 85
            ],
            [
                "name" => "Alpine",
                "pos" => 3,
                "points" => 170
            ],
            [
                "name" => "AstonMartin",
                "pos" => 4,
                "points" => 154
            ],
            [
                "name" => "Ferrari",
                "pos" => 5,
                "points" => 136
            ],
            [
                "name" => "Haas",
                "pos" => 8,
                "points" => 111
            ],
            [
                "name" => "McLaren",
                "pos" => 2,
                "points" => 193
            ],
            [
                "name" => "Mercedes",
                "pos" => 6,
                "points" => 135
            ],
            [
                "name" => "RedBull",
                "pos" => 1,
                "points" => 197
            ],
            [
                "name" => "Williams",
                "pos" => 7,
                "points" => 134
            ]
        );

        foreach ($standings as $team) {
            $teamBase = @imagecreatefrompng("../resources/documents/standings/teams/" . $team['name'] . ".png");
            $pointsBox = @imagecreatefrompng("../resources/documents/standings/PointsBox.png");
            imagecopymerge($base, $teamBase, 42,$coordinatesPos[$team['pos']],0,0, 651, 83,100);
            imagecopymerge($base, $pointsBox, 651 + 52,$coordinatesPos[$team['pos']],0,0, 221, 83,100);
            $tb = imagettfbbox(47, 0, "../resources/fonts/Formula1-Black.ttf", $team['points']);
            $x = ceil((221 - $tb[2]) / 2); // lower left X coordinate for text
            imagettftext($base, 47, 0, $x + 651 + 52, $coordinatesPos[$team['pos']]+68, $this->getTextColor($base) , "../resources/fonts/Formula1-Black.ttf", $team['points']);
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
                    "pos" => 1,
                    "points" => 121
                ],
                [
                    "name" => "Janosch077",
                    "team" => "AstonMartin",
                    "pos" => 2,
                    "points" => 99
                ],
                [
                    "name" => "xbatchris",
                    "team" => "Ferrari",
                    "pos" => 3,
                    "points" => 98
                ],
                [
                    "name" => "Ronlu222",
                    "team" => "McLaren",
                    "pos" => 4,
                    "points" => 97
                ],
                [
                    "name" => "SBBela",
                    "team" => "McLaren",
                    "pos" => 5,
                    "points" => 96
                ],
                [
                    "name" => "Mlody_35",
                    "team" => "EF",
                    "pos" => 6,
                    "points" => 95
                ],
                [
                    "name" => "Tizian",
                    "team" => "Alpine",
                    "pos" => 7,
                    "points" => 83
                ],
                [
                    "name" => "Dezin",
                    "team" => "Alpine",
                    "pos" => 8,
                    "points" => 80
                ],
                [
                    "name" => "Basti1997-TJ",
                    "team" => "RedBull",
                    "pos" => 9,
                    "points" => 76
                ],
                [
                    "name" => "Maxinator0904",
                    "team" => "Mercedes",
                    "pos" => 10,
                    "points" => 76
                ]
            ],
            2 => [
                [
                    "name" => "LSjOM7",
                    "team" => "Mercedes",
                    "pos" => 1,
                    "points" => 66
                ],
                [
                    "name" => "ToniTempo",
                    "team" => "AlfaRomeo",
                    "pos" => 2,
                    "points" => 61
                ],
                [
                    "name" => "ObNöKhEsLeZ",
                    "team" => "Williams",
                    "pos" => 3,
                    "points" => 60
                ],
                [
                    "name" => "Nobbler1975",
                    "team" => "AstonMartin",
                    "pos" => 4,
                    "points" => 55
                ],
                [
                    "name" => "prefy",
                    "team" => "Haas",
                    "pos" => 5,
                    "points" => 48
                ],
                [
                    "name" => "HamburgerJung",
                    "team" => "AlphaTauri",
                    "pos" => 6,
                    "points" => 43
                ],
                [
                    "name" => "DMK160988",
                    "team" => "Haas",
                    "pos" => 7,
                    "points" => 37
                ],
                [
                    "name" => "Mathador1887",
                    "team" => "Ferrari",
                    "pos" => 8,
                    "points" => 27
                ],
                [
                    "name" => "willi87_94",
                    "team" => "Williams",
                    "pos" => 9,
                    "points" => 24
                ],
                [
                    "name" => "Julianus33",
                    "team" => "AlfaRomeo",
                    "pos" => 10,
                    "points" => 22
                ]
            ],
            3 => [
                [
                    "name" => "xPhilippFCB",
                    "team" => "EF",
                    "pos" => 1,
                    "points" => 16
                ],
                [
                    "name" => "SDC_Beesel",
                    "team" => "EF",
                    "pos" => 2,
                    "points" => 14
                ],
                [
                    "name" => "Cuyahoga89",
                    "team" => "AlphaTauri",
                    "pos" => 3,
                    "points" => 13
                ],
                [
                    "name" => "ag_323_ha",
                    "team" => "EF",
                    "pos" => 4,
                    "points" => 8
                ],
                [
                    "name" => "Ramrod",
                    "team" => "EF",
                    "pos" => 5,
                    "points" => 5
                ],
                [
                    "name" => "Riccihsv201",
                    "team" => "EF",
                    "pos" => 6,
                    "points" => 5
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
                imagettftext($base, 47, 0, $x + 651 + 52, $coordinatesPos[$driver['pos']]+68, $this->getNumberTextColor($base) , "../resources/fonts/Formula1-Black.ttf", $driver['points']);
            }
            imagepng($base, "../resources/documents/standings/DriverStandings ". $pageNum .".png");
        }
        //$outputImage = imagecreatefrompng("../resources/documents/standings/test.png");

    }

    private function getNameTextColor($img, $teamName)
    {
        if ($teamName == "Ferrari" || $teamName == "Haas"){
            return imagecolorallocate($img, 0, 0, 0);
        }
        return imagecolorallocate($img, 255, 255, 255);
    }
    private function getNumberTextColor($img)
    {
        return imagecolorallocate($img, 255, 255, 255);
    }
}
