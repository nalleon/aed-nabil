<?php

namespace App\Http\Controllers;

use App\Http\Resources\DirectorResource;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorRESTController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Director $director)
    {
        $director->update($request->only('nombre', 'apellidos'));
        return new DirectorResource($director);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Director $director)
    {
        $director->directoresPeliculas()->detach();
        $director->delete();
        
        return response()->json(null, 204);
    }
}
