<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\CreateUser;
use App\Actions\User\FindUser;
use App\Actions\User\ListUsers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(ListUsers::run());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): UserResource
    {
        return UserResource::make(CreateUser::run($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id): UserResource
    {

        return UserResource::make(User::find($id));
    }
}
