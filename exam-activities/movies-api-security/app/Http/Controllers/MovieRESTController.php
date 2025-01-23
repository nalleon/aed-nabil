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

 /**
    * @OA\Post(
    *   path="/api/movies",
    *   summary="Store a new movie",
    *   description="Store a new movie in the database",
    *   tags={"Movie"},
    *   @OA\RequestBody(
    *       required=true,
    *       description="Movie data",
    *       @OA\JsonContent(
    *           type="object",
    *           required={"titulo", "year", "descripcion", "trailer", "caratula"},
    *           @OA\Property(property="titulo", type="string", description="Title of the movie"),
    *           @OA\Property(property="year", type="integer", description="Release year of the movie"),
    *           @OA\Property(property="descripcion", type="string", description="Description of the movie"),
    *           @OA\Property(property="trailer", type="string", description="URL of the movie trailer"),
    *           @OA\Property(property="caratula", type="string", description="Cover image of the movie"),
    *           @OA\Property(property="categorias", type="array", @OA\Items(type="integer"), description="List of category"),
    *           @OA\Property(property="actores", type="array", @OA\Items(type="integer"), description="List of actors"),
    *           @OA\Property(property="directores", type="array", @OA\Items(type="integer"), description="List of directors")
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Movie created successfully"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid data provided"
    *   )
    * )
    */
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
     * @OA\Put(
     *   path="/api/movies/{id}",
     *   summary="Update an existing movie",
     *   description="Update the details of an existing movie by ID",
     *   tags={"Movie"},
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the movie to update",
     *       @OA\Schema(type="integer")
     *   ),
     *   @OA\RequestBody(
     *       required=true,
     *       description="Updated movie data",
     *       @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="titulo", type="string", description="Title of the movie"),
     *           @OA\Property(property="year", type="integer", description="Release year of the movie"),
     *           @OA\Property(property="descripcion", type="string", description="Description of the movie"),
     *           @OA\Property(property="trailer", type="string", description="URL of the movie trailer"),
     *           @OA\Property(property="caratula", type="string", description="Cover image of the movie"),
     *           @OA\Property(property="categorias", type="array", @OA\Items(type="integer"), description="List of categories"),
     *           @OA\Property(property="actores", type="array", @OA\Items(type="integer"), description="List of actors"),
     *           @OA\Property(property="directores", type="array", @OA\Items(type="integer"), description="List of directors")
     *       )
     *   ),
     *   @OA\Response(
     *       response=200,
     *       description="Movie updated successfully"
     *   ),
     *   @OA\Response(
     *       response=400,
     *       description="Invalid data provided"
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Movie not found"
     *   )
     * )
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
     * @OA\Delete(
     *   path="/api/movies/{id}",
     *   summary="Delete a movie",
     *   description="Delete a movie by ID",
     *   tags={"Movie"},
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="ID of the movie to delete",
     *       @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *       response=204,
     *       description="Movie deleted successfully"
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Movie not found"
     *   )
     * )
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
