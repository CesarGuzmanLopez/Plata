<?php

namespace App\Http\Controllers\AltasYBajas;

use App\Http\Controllers\Controller;
use App\Models\TgCurso;
use Illuminate\Http\Request;

class Cursos extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Administrar.Cursos");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'Nombre' => 'required|unique:tg__curso'
        ]);

        $NuevoCurso = new TgCurso();
        $NuevoCurso->Nombre = $request->Nombre;
        $NuevoCurso->Descripcion = json_encode($request->Descripcion ?? '');
        $NuevoCurso->Premium = $request->Premium ?? false;
        $NuevoCurso->ID_Usuario_Creador = auth()->user()->id;
        return $NuevoCurso->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'required'
        ]);
        $Curso =  TgCurso::whereId($id)->first();
        $Curso->Nombre = $request->Nombre;
        $Curso->Descripcion = json_encode($request->Descripcion ?? '');
        $Curso->Premium = $request->Premium ?? false;
        $Curso->ID_Usuario_Creador = auth()->user()->id;
        $Curso->save();
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cursos =  TgCurso::whereId($id)->first();
        return $cursos->delete();
    }
}
 