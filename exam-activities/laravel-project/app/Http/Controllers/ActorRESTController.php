<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorResource;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorRESTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ActorResource::collection(Actor::all());
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
    public function show(Actor $actor)
    {
        return new ActorResource($actor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        $actor->update($request->only('nombre', 'apellidos'));
        return new ActorResource($actor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        $actor->actoresPeliculas()->detach();
        $actor->delete();
        
        return response()->json(null, 204);
    }
}
