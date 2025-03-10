<?php

namespace App\Http\Controllers;

use App\Http\Resources\AlumnoResource;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoRESTController extends Controller
{
    /**
    * @OA\Get(
    * path="/api/alumnos",
    * summary="Obtener lista de alumnos",
    * description="Retorna una lista de alumnos",
    * tags={"Alumnos"},
    * @OA\Response(
    * response=200,
    * description="Lista de alumnos"
    * )
    * )
    */
    public function index(Request $request){

        $nombreFilter = $request->input('nombre');
        $apellidosFilter = $request->input('apellidos');

        $alumnos = [];

        if(!empty($nombreFilter) || !empty($apellidosFilter)){
            $alumnos = Alumno::where('nombre', 'like', '%'. $nombreFilter . '%')
                        ->where('apellidos', 'like', '%'. $apellidosFilter . '%')
                        ->get();
        } else {
            $alumnos = Alumno::all();
        }

        return AlumnoResource::collection($alumnos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alumno = new Alumno();
        $alumno->dni = $request->input('dni');
        $alumno->nombre = $request->input('nombre');
        $alumno->fechanacimiento = $request->input('fechanacimiento');
        $alumno->curso = $request->input('apellidos');
        $alumno->save();

        return new AlumnoResource($alumno);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return AlumnoResource::show($alumno);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alumno $alumno)
    {
        $alumno->update($request->only('nombre', 'apellidos', 'fechanacimiento'));
        return new AlumnoResource($alumno);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return response()->json(null, 204);
    }
}
