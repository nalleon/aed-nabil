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

        $movie = new Movie();
        $movie->titulo = $request->titulo;
        $movie->year = $request->year;
        $movie->descripcion = $request->descripcion;
        $movie->trailer = $request->trailer;

        /**if ($request->hasFile('image')) {
            $movie->caratula = $request->file('image')->store('images', 'public');
        }*/

        if ($request->has('categories')) {
            $movie->categorias()->attach($request->categorias);
        }
    
        if ($request->has('actors')) {
            $movie->actors()->attach($request->actors);
        }
    
        if ($request->has('directors')) {
            $movie->directors()->attach($request->directors);
        }

        return response()->json($movie->load(['categorias', 'actors', 'directors']), 201);
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
        $movie->categorias()->detach();
        $movie->actors()->detach();
        $movie->directors()->detach();

        $movie->delete();
        return response()->json(null, 204);
    }
}
