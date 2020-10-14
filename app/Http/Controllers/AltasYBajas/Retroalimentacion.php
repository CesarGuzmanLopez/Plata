<?php

namespace App\Http\Controllers\AltasYBajas;

use App\Http\Controllers\Controller;
use App\Models\ReactivosRetroalimentacion;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class Retroalimentacion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Data =[
            'Titulo'=>"Administrar Retroalimentaciones",
            "Ruta"  =>route("AdministrarRetroalimentacion.index")
        ];
        return view("Administrar.Tablas")->with($Data);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $NuevaOpcion                     = new ReactivosRetroalimentacion();
        $NuevaOpcion->Retroalimentacion  = $request->Retroalimentacion;
        $NuevaOpcion->Datos              = json_encode($request->Datos);
        $NuevaOpcion->save();
    }



    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Variables=['id','Retroalimentacion','Datos'];
        $inmutables=['id'];
        $listas =[
            ["ID_Reactivo", "Reactivos", "Difuso", route('AdministrarReactivos.show', "onlyData")]
        ];
        $tiposVariables=["int","html","json"];
        if ($id==="all") {
            return [$tiposVariables,$Variables,ReactivosRetroalimentacion::select($Variables)->get(),$inmutables,$listas];
        }

        if ($id>0) {
            return [
                ReactivosRetroalimentacion::select($Variables)->whereId($id)->first(),
            ];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
                $Reactivo                   = ReactivosRetroalimentacion::whereId($id)->first();
                $Reactivo->ID_Tipo_Pregunta = $request->Retroalimentacion;
                $Reactivo->Datos1           = json_encode($request->Datos);
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
        $Reactivo = ReactivosRetroalimentacion::whereId($id)->first();
        return $Reactivo->delete();
    }
}
