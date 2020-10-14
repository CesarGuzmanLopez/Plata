<?php

namespace App\Http\Controllers\AltasYBajas;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReactivosListasOpcione;
use App\Models\ReactivosOpcione;
use App\Models\ReactivosOpcionesListum;

class Opciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Data =[
            'Titulo'=>"Administrar Opciones",
            "Ruta"  =>route("AdministrarOpciones.index")
        ];
        return view("Administrar.Tablas")->with($Data);
    }

    public function store(Request $request)
    {
        if($request->has("Todo")&&$request->Todo =="Multiple" ){
            $NuevoGrupoOpcion = new ReactivosListasOpcione();
            $NuevoGrupoOpcion->ID_Creador = auth()->user()->id;
            $NuevoGrupoOpcion->Nombre = $request->NombreLista;
            $NuevoGrupoOpcion->save();
            foreach ($request->Datos as $key => $value) {
                $NuevaOpcion = new ReactivosOpcione();
                $NuevaOpcion->ID_Tipo_Pregunta  = $request->ID_Tipo_Pregunta;
                $NuevaOpcion->Enunciado1 =$value;
                $NuevaOpcion->save();
                $AddGrupo = new ReactivosOpcionesListum();
                $AddGrupo->ID_Lista_opcion = $NuevoGrupoOpcion->id;
                $AddGrupo->ID_opcion = $NuevaOpcion->id;
                $AddGrupo->save();
            }
            return $request->Datos;
        }
        $request->validate([
            'Enunciado1' => 'required'
        ]);
        $NuevaOpcion                    = new ReactivosOpcione();
        $NuevaOpcion->ID_Tipo_Pregunta  = $request->ID_Tipo_Pregunta;
        $NuevaOpcion->Enunciado1        = $request->Enunciado1;
        $NuevaOpcion->Datos1            = json_encode($request->Datos1);
        $NuevaOpcion->Enunciado2        = $request->Enunciado2;
        $NuevaOpcion->Datos1            = json_encode($request->Datos1);
        $NuevaOpcion->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $Variables=['id','Enunciado1','Datos1','Enunciado2','Datos2','ID_Tipo_Pregunta'];
        $inmutables=['id'];
        $tiposVariables=["int","html","json" ,"html","json",'int'];
        $listas=[
       //     ["ID_Subtema","Subtemas","Difuso",route('AdministrarTemas.show', "onlyData")]
        ];
        if ($id==="all") {
            return [$tiposVariables,$Variables,ReactivosOpcione::select($Variables)->get(),$inmutables,$listas];
        }
        if ($id==="onlyData") {
            return ReactivosOpcione::select($Variables)->get();
        }
        if($id==="ListasOpcionesMultiples"){
            return ReactivosListasOpcione::select("id", "Nombre")->get();
        }
        if($id==="OpcinesEnIDLista"){
           
            return ReactivosOpcione::select($Variables)->
            leftjoin( 
                    'reactivos__opciones_lista', 
                    "reactivos__opciones_lista.ID_opcion",
                    "=",
                    "reactivos__opciones.id"
            )->distinct()->where("reactivos__opciones_lista.ID_Lista_opcion","=",$request->idlista)->get();
        
        }
        if ($id>0) {
            return [
            ];
        }
        throw  new Exception("Error Desplegando id no definido", 1);
    }
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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
                        'Enunciado1' => 'required'
                ]);
                $Reactivo               = ReactivosOpcione::whereId($id)->first();
                $Reactivo->ID_Tipo_Pregunta  = $request->ID_Tipo_Pregunta;
                $Reactivo->Enunciado1        = $request->Enunciado1;
                $Reactivo->Datos1            = json_encode($request->Datos1);
                $Reactivo->Enunciado2        = $request->Enunciado2;
                $Reactivo->Datos1            = json_encode($request->Datos1);
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
        $Reactivo = ReactivosOpcione::whereId($id)->first();
        return $Reactivo->delete();

    }
}
