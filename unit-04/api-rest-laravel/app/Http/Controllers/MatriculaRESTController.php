<?php

namespace App\Http\Controllers;

use App\Http\Resources\MatriculaResource;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaRESTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MatriculaResource::collection(Matricula::all());

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

        $matricula = new Matricula();
        $matricula->dni = $request->input('dni');
        $matricula->year = $request->input('year');
        $matricula->save();

        $matricula = Matricula::create([
            'alumno_id' => $request->alumno_id,
        ]);

        if ($request->has('asignaturas')) {
            foreach ($request->asignaturas as $asignaturaId) {
                $matricula->asignaturas()->attach($asignaturaId);
            }
        }

        return new MatriculaResource($matricula);
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        return new MatriculaResource($matricula);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {

        $matricula->update($request->only('dni', 'year'));
        $matricula->asignaturas()->detach();

        if ($request->has('asignaturas')) {
            foreach ($request->asignaturas as $asignaturaId) {
                $matricula->asignaturas()->attach($asignaturaId);
            }
        }

        return new MatriculaResource($matricula);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        $matricula->asignaturas()->detach();
        $matricula->delete();

        return response()->json(null, 204);

    }
}
