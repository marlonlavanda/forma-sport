<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function index()
    {
        $data = $this->userRepositoryInterface->index();
        return ApiResponseClass::sendResponse(UserResource::collection($data), 'Users fetched successfully', 200);
    }

    public function store(StoreUserRequest $request)
    {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        DB::beginTransaction();

        try {
            $user = $this->userRepositoryInterface->store($details);
            DB::commit();
            return ApiResponseClass::sendResponse(new UserResource($user), 'User Created Successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }
}
