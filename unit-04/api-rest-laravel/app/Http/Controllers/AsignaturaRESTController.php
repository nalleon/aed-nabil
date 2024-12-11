<?php

namespace App\Http\Controllers;

use App\Http\Resources\AsignaturaResource;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaRESTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AsignaturaResource::collection(Asignatura::all());

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
        $asignatura = new Asignatura();
        $asignatura->nombre = $request->input('nombre');
        $asignatura->curso = $request->input('curso');
        $asignatura->save();

        return new AsignaturaResource($asignatura);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignatura $asignatura)
    {
        return new AsignaturaResource($asignatura);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignatura $asignatura)
    {
        $asignatura->update($request->only('nombre', 'curso'));
        return new AsignaturaResource($asignatura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();
        return response()->json(null, 204);
    }
}
