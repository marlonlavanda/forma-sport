<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymClassRequest;
use App\Http\Requests\UpdateGymClassRequest;
use App\Models\GymClass;
use App\Interfaces\GymClassRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\GymClassResource;
use Illuminate\Support\Facades\DB;

class GymClassController extends Controller
{

    private GymClassRepositoryInterface $gymClassRepositoryInterface;

    public function __construct(GymClassRepositoryInterface $gymClassRepositoryInterface)
    {
        $this->gymClassRepositoryInterface = $gymClassRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->gymClassRepositoryInterface->index();

        return ApiResponseClass::sendResponse(GymClassResource::collection($data), 'Gym classes fetched successfully', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGymClassRequest $request)
    {
        $details = [
            'name' => $request->name,
            'description' => $request->description,
            'schedule' => $request->schedule,
            'instructor_id' => $request->instructor_id,
            'capacity' => $request->capacity
        ];

        DB::beginTransaction();

        try {
            $gymClass = $this->gymClassRepositoryInterface->store($details);

            DB::commit();

            return ApiResponseClass::sendResponse(new GymClassResource($gymClass), 'Class created successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->gymClassRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new GymClassResource($data), 'Class details', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GymClass $gymClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGymClassRequest $request, $id)
    {
        $updateDetails = [
            'name' => $request->name,
            'description' => $request->description,
            'schedule' => $request->schedule,
            'instructor_id' => $request->instructor_id,
            'capacity' => $request->capacity
        ];

        DB::beginTransaction();

        try {
            $this->gymClassRepositoryInterface->update($updateDetails, $id);
            DB::commit();

            return ApiResponseClass::sendResponse('Class updated successfully', '', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->gymClassRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Class deleted successfully', '', 204);
    }
}
