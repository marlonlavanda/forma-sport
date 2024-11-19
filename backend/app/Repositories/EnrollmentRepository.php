<?php

namespace App\Repositories;

use App\Models\Enrollment;
use App\Interfaces\EnrollmentRepositoryInterface;

class EnrollmentRepository implements EnrollmentRepositoryInterface
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
        return Enrollment::all();
    }

    public function getById($id)
    {
        return Enrollment::findOrFail($id);
    }

    public function store(array $data)
    {
        return Enrollment::create($data);
    }

    public function update(array $data, $id)
    {
        return Enrollment::whereId($id)->update($data);
    }

    public function delete($id)
    {
        Enrollment::destroy($id);
    }
}
