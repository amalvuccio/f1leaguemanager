<?php

namespace App\Services;

class StandingsService
{
    public function __construct(
        protected PointsSystemService $pointsSystemService
    ) {

    }

    public function getPointsSystem($id)
    {
        return $this->pointsSystemService->getPointsSystem($id);
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

        //Split A
        $standingsSplitA = array(
            [
                "name" => "RedBull",
                "pos" => 2,
                "points" => 117
            ],
            [
                "name" => "McLaren",
                "pos" => 7,
                "points" => 85
            ],
            [
                "name" => "Mercedes",
                "pos" => 4,
                "points" => 103
            ],
            [
                "name" => "Alpine",
                "pos" => 6,
                "points" => 85
            ],
            [
                "name" => "AstonMartin",
                "pos" => 10,
                "points" => 57
            ],
            [
                "name" => "Williams",
                "pos" => 5,
                "points" => 89
            ],
            [
                "name" => "Ferrari",
                "pos" => 9,
                "points" => 70
            ],
            [
                "name" => "Haas",
                "pos" => 1,
                "points" => 117
            ],
            [
                "name" => "AlphaTauri",
                "pos" => 3,
                "points" => 114
            ],
            [
                "name" => "AlfaRomeo",
                "pos" => 8,
                "points" => 77
            ],
        );

        //Split B
        $standingsSplitB = array(
            [
                "name" => "AlfaRomeo",
                "pos" => 5,
                "points" => 86
            ],
            [
                "name" => "AlphaTauri",
                "pos" => 4,
                "points" => 119
            ],
            [
                "name" => "Alpine",
                "pos" => 1,
                "points" => 156
            ],
            [
                "name" => "RedBull",
                "pos" => 7,
                "points" => 61
            ],
            [
                "name" => "McLaren",
                "pos" => 3,
                "points" => 130
            ],
            [
                "name" => "Mercedes",
                "pos" => 2,
                "points" => 142
            ],
            [
                "name" => "AstonMartin",
                "pos" => 9,
                "points" => 45
            ],
            [
                "name" => "Williams",
                "pos" => 6,
                "points" => 62
            ],
            [
                "name" => "Ferrari",
                "pos" => 8,
                "points" => 49
            ],
            [
                "name" => "Haas",
                "pos" => 10,
                "points" => 6
            ]
        );

        $standings = $standingsSplitA;

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

        //Split A
        $standingsSplitA = array(
            1 => [
                [
                    "name" => "Bayernfreaky",
                    "team" => "AlphaTauri",
                    "pos" => 3,
                    "points" => 66
                ],
                [
                    "name" => "mika.ostfeld",
                    "team" => "Haas",
                    "pos" => 2,
                    "points" => 83
                ],
                [
                    "name" => "Basti1997-TJ",
                    "team" => "RedBull",
                    "pos" => 1,
                    "points" => 86
                ],
                [
                    "name" => "willi87_94",
                    "team" => "Williams",
                    "pos" => 8,
                    "points" => 43
                ],
                [
                    "name" => "Nobbler1975",
                    "team" => "AlfaRomeo",
                    "pos" => 7,
                    "points" => 47
                ],
                [
                    "name" => "SBBela",
                    "team" => "McLaren",
                    "pos" => 6,
                    "points" => 52
                ],
                [
                    "name" => "MrMartin",
                    "team" => "Alpine",
                    "pos" => 5,
                    "points" => 53
                ],
                [
                    "name" => "LSjOM7",
                    "team" => "Mercedes",
                    "pos" => 4,
                    "points" => 61
                ],
                [
                    "name" => "Wave Marco",
                    "team" => "EF",
                    "pos" => 9,
                    "points" => 42
                ],
                [
                    "name" => "Clemente1804",
                    "team" => "Ferrari",
                    "pos" => 10,
                    "points" => 38
                ]
            ],
            2 => [
                [
                    "name" => "xbatchris",
                    "team" => "Ferrari",
                    "pos" => 2,
                    "points" => 36
                ],
                [
                    "name" => "DMK160988",
                    "team" => "AlphaTauri",
                    "pos" => 1,
                    "points" => 36
                ],
                [
                    "name" => "Mlody_35",
                    "team" => "Haas",
                    "pos" => 4,
                    "points" => 28
                ],
                [
                    "name" => "ObNöKhEsLeZ",
                    "team" => "Williams",
                    "pos" => 3,
                    "points" => 33
                ],
                [
                    "name" => "Ronlu222",
                    "team" => "McLaren",
                    "pos" => 9,
                    "points" => 22
                ],
                [
                    "name" => "NTS Kaimi",
                    "team" => "EF",
                    "pos" => 8,
                    "points" => 22
                ],
                [
                    "name" => "Janosch077",
                    "team" => "AlfaRomeo",
                    "pos" => 6,
                    "points" => 25
                ],
                [
                    "name" => "Dezin",
                    "team" => "AstonMartin",
                    "pos" => 10,
                    "points" => 20
                ],
                [
                    "name" => "tiz_haa",
                    "team" => "AstonMartin",
                    "pos" => 7,
                    "points" => 23
                ],
                [
                    "name" => "Maxinator0904",
                    "team" => "RedBull",
                    "pos" => 5,
                    "points" => 28
                ]
            ],
            3 => [
                [
                    "name" => "aka_scharfi_82",
                    "team" => "Mercedes",
                    "pos" => 2,
                    "points" => 14
                ],
                [
                    "name" => "Phil",
                    "team" => "Alpine",
                    "pos" => 1,
                    "points" => 16
                ]
            ]
        );

        //Split B
        $standingsSplitB = array(
            1 => [
                [
                    "name" => "MaRe",
                    "team" => "Alpine",
                    "pos" => 1,
                    "points" => 93
                ],
                [
                    "name" => "Mathador1887",
                    "team" => "Alpine",
                    "pos" => 6,
                    "points" => 63
                ],
                [
                    "name" => "Paddy938413",
                    "team" => "McLaren",
                    "pos" => 4,
                    "points" => 68
                ],
                [
                    "name" => "IIMOWII",
                    "team" => "AlphaTauri",
                    "pos" => 5,
                    "points" => 63
                ],
                [
                    "name" => "GroundMSL",
                    "team" => "AlphaTauri",
                    "pos" => 3,
                    "points" => 69
                ],
                [
                    "name" => "KingRA2601",
                    "team" => "Mercedes",
                    "pos" => 2,
                    "points" => 81
                ],
                [
                    "name" => "SDC_Beesel",
                    "team" => "McLaren",
                    "pos" => 7,
                    "points" => 62
                ],
                [
                    "name" => "MaxiTraunsee",
                    "team" => "Mercedes",
                    "pos" => 8,
                    "points" => 61
                ],
                [
                    "name" => "ToniTempo",
                    "team" => "RedBull",
                    "pos" => 10,
                    "points" => 50
                ],
                [
                    "name" => "ag_323_ha",
                    "team" => "AlfaRomeo",
                    "pos" => 9,
                    "points" => 51
                ]
            ],
            2 => [
                [
                    "name" => "Peet1992",
                    "team" => "Williams",
                    "pos" => 1,
                    "points" => 48
                ],
                [
                    "name" => "MagischerTod",
                    "team" => "AstonMartin",
                    "pos" => 2,
                    "points" => 45
                ],
                [
                    "name" => "Robustus19",
                    "team" => "AlfaRomeo",
                    "pos" => 3,
                    "points" => 35
                ],
                [
                    "name" => "TGL Norris",
                    "team" => "Ferrari",
                    "pos" => 4,
                    "points" => 25
                ],
                [
                    "name" => "Z1dan01",
                    "team" => "Ferrari",
                    "pos" => 5,
                    "points" => 24
                ],
                [
                    "name" => "Dschoakim",
                    "team" => "Williams",
                    "pos" => 9,
                    "points" => 14
                ],
                [
                    "name" => "Schauni",
                    "team" => "EF",
                    "pos" => 8,
                    "points" => 16
                ],
                [
                    "name" => "Schuberto92",
                    "team" => "EF",
                    "pos" => 6,
                    "points" => 22
                ],
                [
                    "name" => "NickvonW46",
                    "team" => "EF",
                    "pos" => 7,
                    "points" => 17
                ],
                [
                    "name" => "Julianus33",
                    "team" => "RedBull",
                    "pos" => 10,
                    "points" => 11
                ]
            ],
            3 => [
                [
                    "name" => "Lord_Harry89",
                    "team" => "EF",
                    "pos" => 1,
                    "points" => 9
                ],
                [
                    "name" => "Riccihsv201",
                    "team" => "Haas",
                    "pos" => 2,
                    "points" => 7
                ]
            ]
        );

        $standings = $standingsSplitA;

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
