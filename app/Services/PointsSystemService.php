<?php

namespace App\Services;

use App\Models\PointsSystemModel;

class PointsSystemService
{
    public function __construct(
    ) {

    }

    public function getPointsSystem($id)
    {
        $builder = PointsSystemModel::query();
        $pointsSystem = $builder->where(PointsSystemModel::ID, "=", $id)
            ->get();

        foreach ($pointsSystem as $pos) {
            $return[$pos['pos']] = (int)$pos['points'];
        }

        return $return;
    }
}
