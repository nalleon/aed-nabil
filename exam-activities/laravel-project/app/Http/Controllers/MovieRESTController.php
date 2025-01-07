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
        $movie->caratula = $request->caratula;

        /**if ($request->hasFile('image')) {
            $movie->caratula = $request->file('image')->store('images', 'public');
        }*/

        //dd($movie);
        $movie->save();

        if ($request->has('categorias')) {
            
            $movie->categoriasPeliculas()->attach($request->categorias);
        }

        if ($request->has('actores')) {
            $movie->actoresPeliculas()->attach($request->actores);
        }

        if ($request->has('directores')) {
            $movie->directoresPeliculas()->attach($request->directores);
        }

    
        return response()->json('saved', 201);
        
        //return response()->json($movie->load(['categorias', 'actores', 'directores']), 201);
    }


    function checkIfCategoryExist(){

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
    public function show(Movie $movie){
        return new MovieResource($movie);
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
        $movie->update($request->only('titulo', 'year', 'descripcion', 'trailer', 'caratula', 'categorias', 'actores', 'directores'));

        if ($request->has('categorias')) {
            $movie->categoriasPeliculas()->sync($request->categorias);
        }
        if ($request->has('actores')) {
            $movie->actoresPeliculas()->sync($request->actores);
        }
        if ($request->has('directores')) {
            $movie->directoresPeliculas()->sync($request->directores);
        }

        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->categoriasPeliculas()->detach();
        $movie->actoresPeliculas()->detach();
        $movie->directoresPeliculas()->detach();

        $movie->delete();
        return response()->json(null, 204);
    }
}
