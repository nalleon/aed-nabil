<?php

namespace App\Http\Controllers;

use App\Domain\Ports\Primary\IUserService;
use App\Http\Resources\UserDTO;
use App\Http\Resources\UserDTOV3;
use App\Models\User;
use Illuminate\Http\Request;

class UserRESTControllerV3 extends Controller
{

    public function __construct(private IUserService $service)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserDTOV3::collection(User::all());
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
