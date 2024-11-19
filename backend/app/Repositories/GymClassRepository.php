<?php

namespace App\Repositories;

use App\Models\GymClass;
use App\Interfaces\GymClassRepositoryInterface;

class GymClassRepository implements GymClassRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index()
    {
        return GymClass::all();
    }

    public function getById($id)
    {
        return GymClass::findOrFail($id);
    }

    public function store(array $data)
    {
        return GymClass::create($data);
    }

    public function update(array $data, $id)
    {
        return GymClass::whereId($id)->update($data);
    }

    public function delete($id)
    {
        GymClass::destroy($id);
    }
}
