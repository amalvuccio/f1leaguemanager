<?php

namespace App\Http\Controllers;

use App\Models\ConstructorModel;
use Illuminate\Database\Eloquent\Collection;

class ConstructorController
{
    public function __construct()
    {
    }

    public function index(): Collection
    {
        return ConstructorModel::all();
    }

    public function details(int $id): Collection
    {
        return ConstructorModel::query()->findOrFail($id);
    }
}
