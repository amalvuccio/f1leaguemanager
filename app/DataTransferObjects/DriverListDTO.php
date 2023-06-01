<?php

namespace App\DataTransferObjects;

use App\Models\DriverModel;

class DriverListDTO implements \JsonSerializable
{
    public DriverModel $driverList;

    public function __construct(Collection $drivers)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            "constructor" => $this->constructor,
            "driverList" => $this->driverList
        ];
    }

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
