<?php

namespace App\DataTransferObjects;

use App\Models\ConstructorModel;

class TeamDTO implements \JsonSerializable
{
    public ConstructorModel $constructor;
    public DriverListDTO $driverList;

    public function __construct(ConstructorModel $constructor, DriverListDTO $driverList)
    {
        $this->constructor = $constructor;
        $this->driverList = $driverList;
    }

    public function jsonSerialize(): array
    {
        return [
            "constructor" => $this->constructor,
            "driverList" => $this->driverList
        ];
    }
}
