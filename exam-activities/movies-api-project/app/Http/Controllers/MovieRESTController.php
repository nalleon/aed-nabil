<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieRESTController extends Controller
{
    /**
    * @OA\Get(
    *   path="/api/movies",
    *   summary="Obtain the movies list",
    *   description="Returns the list of movies",
    *   tags={"Movie"},
    * @OA\Response(
    *   response=200,
    *   description="List of movies"
    *   )
    * )
    */
    public function index()
    {
        return MovieResource::collection(Movie::all());
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }
    /**
    * @OA\Get(
    *     path="/api/movies/{id}",
    *     summary="Get a specific movie",
    *     description="Returns a specific movie by ID",
    *     tags={"Movie"},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         description="ID of the movie",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Movie details",
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Movie not found"
    *     )
    * )
    */
    public function show(Movie $movie)
    {
        return MovieResource::show($movie);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->only('titulo', 'year', 'descripcion', 'trailer', 'caratula'));
        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }
}
