<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Http\Requests\EstudianteRequest;
class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Estudiante::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstudianteRequest $request)
    {
        $estudiante = new Estudiante;
        $estudiante->nombres=$request->nombres;
        $estudiante->apellidos=$request->apellidos;
        $estudiante->fecha_de_nacimiento=$request->fecha_de_nacimiento;
        $estudiante->correo=$request->correo;
        $estudiante->curso=$request->curso;
        $estudiante->save();

        return response('Creado un nuevo Estudiante Satifactoriamente',201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Estudiante::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstudianteRequest $request, $id)
    {
        $estudiante =  Estudiante::find($id);
        $estudiante->nombres=$request->nombres;
        $estudiante->apellidos=$request->apellidos;
        $estudiante->fecha_de_nacimiento=$request->fecha_de_nacimiento;
        $estudiante->correo=$request->correo;
        $estudiante->curso=$request->curso;
        $estudiante->save();


        return response('Estudiante Actualizado Satifactoriamente',201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Estudiante::find($id)->delete();
        return response('Estudiante  Eliminado Satifactoriamente',200);
    }
}
