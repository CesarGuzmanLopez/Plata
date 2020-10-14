<?php

namespace App\Http\Controllers\AltasYBajas;

use App\Http\Controllers\Controller;
use App\Models\TgCurso;
use App\Models\TgCursoTemasDifuso;
use App\Models\TgGradoCursosDifuso;
use App\Models\TgGradosAcademico;
use Exception;
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
        $Data = [
            'Titulo' => "Administrar Cursos",
            "Ruta" => route("AdministrarCursos.index"),
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
        $request->validate([
            'Nombre' => 'required|unique:tg__curso',
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
    public function show(Request $request, String $id)
    {
        $Variables = ['id', 'Nombre', 'Descripcion', 'Premium'];
        $inmutables = ['id'];
        $tiposVariables = ["int", "string", "json", "boolean"];
        $listas = [
            ["ID_Tema", "Temas", "Difuso", route('AdministrarTemas.show', "onlyData")],
        ];
        if ($id === "all") {
            return [$tiposVariables, $Variables, TgCurso::select($Variables)->get(), $inmutables, $listas];
        }
        if ($id === "onlyData") {
            return TgCurso::select($Variables)->get();
        }

        if ($id === "Temas") {
            $temas = TgCursoTemasDifuso::where("ID_Curso", $request->id)->get();
            // echo dd($temas);
            $Regreso = [];
            foreach ($temas as $key => $value) {
                array_push($Regreso, ["Nombre" => $value->tg_tema->Nombre, "id" => $value->tg_tema->id]);
            }
            return $Regreso;
        }
        if ($id === "Grado") {
            return TgGradosAcademico::select(["id", "Nombre"])->whereId(TgGradoCursosDifuso::whereIdCurso($request->id)->first()->ID_Grado)->first();
        }
        if ($id > 0) {
            return [
                TgCursoTemasDifuso::select(["ID_Tema", "valor"])->where("ID_Curso", $id)->get(),
                TgCurso::select($Variables)->whereId($id)->first(),
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
    public function edit($id)
    {
        return TgCursoTemasDifuso::select(["ID_Tema", "valor"])->whereIDCurso($id)->get();
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
            case 'Temas':
                foreach ($request->relacionValor as $indice => $valor) {
                    $Elemento = TgCursoTemasDifuso::where("ID_Curso", "=", $id)->where("ID_Tema", "=", $indice);
                    $valor = $valor ?? 0;
                    if ($Elemento) {
                        $Elemento->delete();
                    }
                    settype($valor, 'float');
                    if ($valor > 0) {
                        $nuevaRelacion = new TgCursoTemasDifuso();
                        $nuevaRelacion->ID_Curso = $id;
                        $nuevaRelacion->ID_Tema = $indice;
                        $nuevaRelacion->valor = $valor;
                        $nuevaRelacion->save();
                    }
                }
                return;
            default:
                $request->validate([
                    'Nombre' => 'required',
                ]);
                $Curso = TgCurso::whereId($id)->first();
                $Curso->Nombre = $request->Nombre;
                $Curso->Descripcion = json_encode($request->Descripcion ?? '');
                $Curso->Premium = $request->Premium ?? false;
                $Curso->ID_Usuario_Creador = auth()->user()->id;
                $Curso->save();
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
        $cursos = TgCurso::whereId($id)->first();
        return $cursos->delete();
    }
}
