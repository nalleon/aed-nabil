<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorResource;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorRESTController extends Controller
{
    /**
    * @OA\Get(
    *   path="/api/actors",
    *   summary="Obtain the actors list",
    *   description="Returns the list of actors",
    *   tags={"Actor"},
    * @OA\Response(
    *   response=200,
    *   description="List of actors"
    *   )
    * )
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
    * @OA\Post(
    *   path="/api/actors",
    *   summary="Store a new actor",
    *   description="Store a new actor in the database",
    *   tags={"Actor"},
    *   @OA\RequestBody(
    *       required=true,
    *       description="Actor data",
    *       @OA\JsonContent(
    *           type="object",
    *           required={"nombre", "apellidos"},
    *           @OA\Property(property="nombre", type="string", description="First name of the actor"),
    *           @OA\Property(property="apellidos", type="string", description="Last name of the actor"),
    *           @OA\Property(property="peliculas", type="array", @OA\Items(type="integer"), description="List of movie IDs related to the actor")
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Actor created successfully"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid data provided"
    *   )
    * )
    */
    public function store(Request $request)
    {
        $actor = new Actor();
        $actor->nombre = $request->nombre;
        $actor->apellidos = $request->apellidos;
        $actor->save();

        if ($request->has('peliculas')) {
            $actor->actoresPeliculas()->attach($request->peliculas);
        }

        return response()->json('saved', 201);
    }

    /**
    * @OA\Get(
    *   path="/api/actors/{id}",
    *   summary="Get a specific actor",
    *   description="Returns the details of a specific actor by ID",
    *   tags={"Actor"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the actor",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Actor details",
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Actor not found"
    *   )
    * )
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
    * @OA\Put(
    *   path="/api/actors/{id}",
    *   summary="Update an existing actor",
    *   description="Update the details of an existing actor by ID",
    *   tags={"Actor"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the actor to update",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\RequestBody(
    *       required=true,
    *       description="Updated actor data",
    *       @OA\JsonContent(
    *           type="object",
    *           @OA\Property(property="nombre", type="string", description="First name of the actor"),
    *           @OA\Property(property="apellidos", type="string", description="Last name of the actor")
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Actor updated successfully"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid data provided"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Actor not found"
    *   )
    * )
    */
    public function update(Request $request, Actor $actor)
    {
        $actor->update($request->only('nombre', 'apellidos'));
        return new ActorResource($actor);
    }

 /**
    * @OA\Delete(
    *   path="/api/actors/{id}",
    *   summary="Delete an actor",
    *   description="Delete an actor by ID",
    *   tags={"Actor"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the actor to delete",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\Response(
    *       response=204,
    *       description="Actor deleted successfully"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Actor not found"
    *   )
    * )
    */
    public function destroy(Actor $actor)
    {

        $actor->actoresPeliculas()->detach();
        $actor->delete();
    
        return response()->json(null, 204);
    }
}
