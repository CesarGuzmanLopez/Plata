<?php

namespace App\Http\Controllers\AltasYBajas;

use App\Http\Controllers\Controller;
use App\Models\TgGradoCursosDifuso;
use App\Models\TgGradosAcademico;
use Exception;
use Illuminate\Http\Request;

class Grados extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view("Administrar.Grados");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'Nombre' => 'required|unique:tg__grados_academicos',
        ]);
        $NuevoTema = new TgGradosAcademico();
        $NuevoTema->Nombre = $request->Nombre;
        $NuevoTema->ID_Usuario_Creador = auth()->user()->id;
        return $NuevoTema->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(String $id){
        $Variables = ['id', 'Nombre'];
        $inmutables = ['id'];
        $tiposVariables = ["int", "string"];
        $listas = [
            ["id", "Cursos", "Difuso", route('AdministrarCursos.show', "onlyData")]
        ] ;
        if ($id === "all") {
            return [$tiposVariables, $Variables, TgGradosAcademico::select($Variables)->get(), $inmutables, $listas];
        }
        if ($id === "onlyData") {
            return TgGradosAcademico::select($Variables)->get();
        }
        if( $id>0){
            return [
                TgGradoCursosDifuso::select(["ID_Curso","valor"])->whereIdGrado($id)->get(),
                TgGradosAcademico::select($Variables)->whereId($id)->first(),
            ];
        }
        throw new Exception("Error Desplegando id no definido", 1);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $request->validate([
            'Nombre' => 'required',
        ]);
        $Tema = TgGradosAcademico::whereId($id)->first();
        $Tema->Nombre = $request->Nombre;
        $Tema->ID_Usuario_Creador = auth()->user()->id;
        $Tema->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $Tema = TgGradosAcademico::whereId($id)->first();
        return $Tema->delete();
    }
}
