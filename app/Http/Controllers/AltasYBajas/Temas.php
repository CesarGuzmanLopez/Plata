<?php

namespace App\Http\Controllers\AltasYBajas;

use App\Http\Controllers\Controller;
use App\Models\TgSubtemasDifuso;
use Illuminate\Http\Request;
use App\Models\TgTema;
use App\Models\User;
use Exception;

class Temas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Data =[
            'Titulo'=>"Administrar Temas",
            "Ruta"  =>route("AdministrarTemas.index")
        ];
        return view("Administrar.Tablas")->with($Data);
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
        $tiposVariables=["int","string","json" ,"boolean"];
        $listas=[
            ["ID_Subtema","Subtemas","Difuso",route('AdministrarTemas.show', "onlyData")]
        ];
        if ($id==="all") {
        
            return [$tiposVariables,$Variables,TgTema::select($Variables)->get(),$inmutables,$listas];
        
        }
        if ($id==="onlyData") {
            return TgTema::select($Variables)->get();
        }
        if ($id>0) {
            return [
                TgSubtemasDifuso::select(["ID_Subtema","valor"])->where("ID_Tema", $id)->get(),
                TgTema::select($Variables)->whereId($id)->first()
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
        switch ($request->update) {
            case 'Subtemas':
                foreach ($request->relacionValor as $indice=>$valor) {
                    $Elemento = TgSubtemasDifuso::where("ID_Tema", "=", $id)->where("ID_Subtema", "=", $indice);
                    $valor = $valor??0;
                    if ($Elemento) {
                        $Elemento->delete();
                    }
                    settype($valor, 'float');
                    if ($valor>0 || $indice==$id) {
                        $nuevaRelacion = new TgSubtemasDifuso();
                        $nuevaRelacion->ID_Tema         =$id;
                        $nuevaRelacion->ID_Subtema      =$indice;
                        $nuevaRelacion->valor           =($indice==$id)?100: $valor;
                        $nuevaRelacion->save();
                    }
                }
                return;
            default:
                $request->validate([
                    'Nombre' => 'required'
                ]);
                $Tema =  TgTema::whereId($id)->first();
                $Tema->Nombre = $request->Nombre;
                $Tema->Descripcion = json_encode($request->Descripcion ?? '');
                $Tema->Premium = $request->Premium ?? false;
                $Tema->ID_Usuario_Creador = auth()->user()->id;
                $Tema->save();
                return;
        }
        throw new Exception("Error id no definido para actualizar", 1);

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
