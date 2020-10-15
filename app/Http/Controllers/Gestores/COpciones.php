<?php

namespace App\Http\Controllers\Gestores;

use App\Http\Controllers\Controller;
use App\Models\ReactivosGruposTipo;
use App\Models\ReactivosListasOpcione;
use App\Models\ReactivosOpcione;
use App\Models\ReactivosOpcionesListum;
use Exception;
use Illuminate\Http\Request;

class Opciones extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       
       
       
        if ($request->tipo=="OpcionesMultiples") {
            $Data=[
                'ID_Tipo'=>ReactivosGruposTipo::where("Nombre","=","Opciones multiples")->first()->id
            ];
            return view("Gestores.OpcionesMultiples")->with($Data);
        }
        return error_reporting(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has("Todo")&&$request->Todo =="Multiple" ){

            $request->validate(['NombreLista'=>'required']);
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
            foreach($request->Respuestas_Seleccionadas as $key => $value){
                if ($value) {
                    $AddGrupo = new ReactivosOpcionesListum();
                    $AddGrupo->ID_Lista_opcion = $NuevoGrupoOpcion->id;
                    $AddGrupo->ID_opcion = $key;
                    $AddGrupo->save();
                }
            }
            return $request->Datos;
        }
        throw new Exception("Controlador no encontrado");
        return ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $Variables=['id','Enunciado1','Datos1','Enunciado2','Datos2','ID_Tipo_Pregunta'];

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
