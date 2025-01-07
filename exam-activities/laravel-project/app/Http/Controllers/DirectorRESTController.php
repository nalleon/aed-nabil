<?php

namespace App\Http\Controllers;

use App\Http\Resources\DirectorResource;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorRESTController extends Controller
{
    /**
    * @OA\Get(
    *   path="/api/directors",
    *   summary="Obtain the directors list",
    *   description="Returns the list of directors",
    *   tags={"Director"},
    * @OA\Response(
    *   response=200,
    *   description="List of directors"
    *   )
    * )
    */
    public function index()
    {
        return DirectorResource::collection(Director::all());
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
    *   path="/api/directors",
    *   summary="Store a new director",
    *   description="Store a new director in the database",
    *   tags={"Director"},
    *   @OA\RequestBody(
    *       required=true,
    *       description="Director data",
    *       @OA\JsonContent(
    *           type="object",
    *           required={"nombre", "apellidos"},
    *           @OA\Property(property="nombre", type="string", description="First name of the director"),
    *           @OA\Property(property="apellidos", type="string", description="Last name of the director"),
    *           @OA\Property(property="peliculas", type="array", @OA\Items(type="integer"), description="List of movie IDs related to the director")
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Director created successfully"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid data provided"
    *   )
    * )
    */
    public function store(Request $request)
    {
        $director = new Director();
        $director->nombre = $request->nombre;
        $director->apellidos = $request->apellidos;
        $director->save();

        if ($request->has('peliculas')) {
            $director->actoresPeliculas()->attach($request->peliculas);
        }

        return response()->json('saved', 201);
    }

/**
    * @OA\Get(
    *   path="/api/directors/{id}",
    *   summary="Get a specific director",
    *   description="Returns the details of a specific director by ID",
    *   tags={"Director"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the director",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Director details",
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Director not found"
    *   )
    * )
    */
    public function show(Director $director)
    {
        return new DirectorResource($director);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Director $director)
    {
        //
    }

/**
    * @OA\Put(
    *   path="/api/directors/{id}",
    *   summary="Update an existing director",
    *   description="Update the details of an existing director by ID",
    *   tags={"Director"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the director to update",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\RequestBody(
    *       required=true,
    *       description="Updated director data",
    *       @OA\JsonContent(
    *           type="object",
    *           @OA\Property(property="nombre", type="string", description="First name of the director"),
    *           @OA\Property(property="apellidos", type="string", description="Last name of the director")
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Director updated successfully"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid data provided"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Director not found"
    *   )
    * )
    */
    public function update(Request $request, Director $director)
    {
        $director->update($request->only('nombre', 'apellidos'));
        return new DirectorResource($director);
    }

    /**
    * @OA\Delete(
    *   path="/api/directors/{id}",
    *   summary="Delete a director",
    *   description="Delete a director by ID",
    *   tags={"Director"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the director to delete",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\Response(
    *       response=204,
    *       description="Director deleted successfully"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Director not found"
    *   )
    * )
    */
    public function destroy(Director $director)
    {
        $director->directoresPeliculas()->detach();
        $director->delete();
        
        return response()->json(null, 204);
    }
}
