<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRESTController extends Controller
{
    /**
    * @OA\Get(
    *   path="/api/categories",
    *   summary="Obtain the category list",
    *   description="Returns the list of category",
    *   tags={"Category"},
    * @OA\Response(
    *   response=200,
    *   description="List of category"
    *   )
    * )
    */
    public function index()
    {
        return CategoryResource::collection(Category::all());
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
    *   path="/api/categories",
    *   summary="Store a new category",
    *   description="Store a new category in the database",
    *   tags={"Category"},
    *   @OA\RequestBody(
    *       required=true,
    *       description="Category data",
    *       @OA\JsonContent(
    *           type="object",
    *           required={"nombre"},
    *           @OA\Property(property="nombre", type="string", description="Name of the category"),
    *           @OA\Property(property="peliculas", type="array", @OA\Items(type="integer"), description="List of movie IDs related to the category")
    *       )
    *   ),
    *   @OA\Response(
    *       response=201,
    *       description="Category created successfully"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid data provided"
    *   )
    * )
    */
    public function store(Request $request)
    {
        $actor = new Category();
        $actor->nombre = $request->nombre;
        $actor->save();

        if ($request->has('peliculas')) {
            $actor->actoresPeliculas()->attach($request->peliculas);
        }

        return response()->json('saved', 201);
    }

    /**
    * @OA\Get(
    *   path="/api/categories/{id}",
    *   summary="Get a specific category",
    *   description="Returns the details of a specific category by ID",
    *   tags={"Category"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the category",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Category details",
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Category not found"
    *   )
    * )
    */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

/**
    * @OA\Put(
    *   path="/api/categories/{id}",
    *   summary="Update an existing category",
    *   description="Update the details of an existing category by ID",
    *   tags={"Category"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the category to update",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\RequestBody(
    *       required=true,
    *       description="Updated category data",
    *       @OA\JsonContent(
    *           type="object",
    *           @OA\Property(property="nombre", type="string", description="Name of the category")
    *       )
    *   ),
    *   @OA\Response(
    *       response=200,
    *       description="Category updated successfully"
    *   ),
    *   @OA\Response(
    *       response=400,
    *       description="Invalid data provided"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Category not found"
    *   )
    * )
    */
    public function update(Request $request, Category $category)
    {
        $category->update($request->only('nombre'));
        return new CategoryResource($category);
    }

    /**
    * @OA\Delete(
    *   path="/api/categories/{id}",
    *   summary="Delete a category",
    *   description="Delete a category by ID",
    *   tags={"Category"},
    *   @OA\Parameter(
    *       name="id",
    *       in="path",
    *       required=true,
    *       description="ID of the category to delete",
    *       @OA\Schema(type="integer")
    *   ),
    *   @OA\Response(
    *       response=204,
    *       description="Category deleted successfully"
    *   ),
    *   @OA\Response(
    *       response=404,
    *       description="Category not found"
    *   )
    * )
    */
    public function destroy(Category $category)
    {
        $category->categoriasPeliculas()->detach();
        $category->delete();
        
        return response()->json(null, 204);
    }
}
