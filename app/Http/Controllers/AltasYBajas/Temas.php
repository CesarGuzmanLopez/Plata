<?php

namespace App\Http\Controllers\AltasYBajas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TgTema;
use App\Models\User;
use Exception;

class Temas extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(){
       return view("Administrar.Temas");
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
            'Nombre' => 'required|unique:tg__temas'
        ]);
        $NuevoTema = new TgTema();
        $NuevoTema->Nombre = $request->Nombre;
        $NuevoTema->Descripcion = json_encode($request->Descripcion ?? '');
        $NuevoTema->Premium = $request->Premium ?? false;
        $NuevoTema->ID_Usuario_Creador = auth()->user()->id;
        return $NuevoTema->save();
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $Variables=['id','Nombre','Descripcion','Premium'];
        $inmutables=['id'];
        $tiposVariables=["int","string","text" ,"boolean"];
        if ($id==="all") {
            return [$tiposVariables,$Variables,TgTema::select($Variables)->get(),$inmutables];
        }
        if($id==="onlyData"){
            TgTema::select($Variables)->get();
        }
        throw  new Exception("Error Desplegando id no definido", 1);
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
        $Tema =  TgTema::whereId($id)->first();
        $Tema->Nombre = $request->Nombre;
        $Tema->Descripcion = json_encode($request->Descripcion ?? '');
        $Tema->Premium = $request->Premium ?? false;
        $Tema->ID_Usuario_Creador = auth()->user()->id;
        $Tema->save();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Tema =  TgTema::whereId($id)->first();
        return $Tema->delete();
    }
}
