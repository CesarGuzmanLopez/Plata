<?php
namespace App\Http\Controllers\Gestores;

use App\Http\Controllers\AltasYBajas\Grados;
use App\Http\Controllers\Controller;
use App\Models\TgCurso;
use App\Models\TgCursoTemasDifuso;
use App\Models\TgGradoCursosDifuso;
use Illuminate\Http\Request;

class CursosGradosTemas extends Controller
{
    public function index()
    {
        $Grados = new  Grados;
        $data = [
            "Grados"    =>$Grados->show("onlyData")
        ];
        return view("Administrar.CGT",$data);
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
            'Nombre_Curso' => 'required',
        ]);
        $NuevoCurso= new TgCurso();
        $NuevoCurso->ID_Usuario_Creador = auth()->user()->id;
        $NuevoCurso->Nombre             = $request->Nombre_Curso;
        $NuevoCurso->Descripcion        = json_encode($request->Descripcion_Curso);
        $NuevoCurso->save();

        if ($request->Grado) {
            $CursoGrados                =new TgGradoCursosDifuso();
            $CursoGrados->ID_Curso      =$NuevoCurso->id;
            $CursoGrados->ID_Grado      =$request->Grado;
            $CursoGrados->valor         =100;
            $CursoGrados->save();
        }

        foreach ($request->Magnitud as $key => $value) {
            if ($value && $value>0) {
                $CursoTemas = new TgCursoTemasDifuso();
                $CursoTemas->ID_Curso   = $NuevoCurso->id;
                $CursoTemas->ID_Tema    = $key;
                $CursoTemas->valor      = $value;
                $CursoTemas->save();
            }
        }
        return $NuevoCurso->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

    }
}
