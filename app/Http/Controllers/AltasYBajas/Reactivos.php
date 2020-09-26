<?php

namespace App\Http\Controllers\AltasYBajas;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReactivosReactivo;

class Reactivos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Administrar.Reactivos");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|unique:reactivos__reactivos'
        ]);
        $nuevoReactivo              = new ReactivosReactivo();
        $nuevoReactivo->Nombre      = $request->Nombre;
        $nuevoReactivo->Enunciado   = $request->Enunciado;
        $nuevoReactivo->Datos       = json_encode($request->Datos);
        $nuevoReactivo->ID_Creador  = auth()->user()->id;
        $nuevoReactivo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Variables=['id','Nombre','Enunciado','Datos'];
        $inmutables=['id'];
        $tiposVariables=["int","string","html" ,"json"];
        $listas=[
       //     ["ID_Subtema","Subtemas","Difuso",route('AdministrarTemas.show', "onlyData")]
        ];
        if ($id==="all") {
            return [$tiposVariables,$Variables,ReactivosReactivo::select($Variables)->get(),$inmutables,$listas];
        }
        if ($id==="onlyData") {
            
        }
        if ($id>0) {
            return [
            ];
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
        switch($request->relacionValor){
            case 'auno':
                    ;
                break;
            default:
                $request->validate([
                    'Nombre' => 'required'
                ]);
                $Reactivo               = ReactivosReactivo::whereId($id)->first();
                $Reactivo->Nombre       = $request->Nombre;
                $Reactivo->Enunciado    = $request->Enunciado;
                $Reactivo->Datos        = json_encode($request->Datos);
                $Reactivo->ID_Creador   = auth()->user()->id;
                $Reactivo->save();
                return; 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Reactivo = ReactivosReactivo::whereId($id)->first();
        return $Reactivo->delete();

    }
}
