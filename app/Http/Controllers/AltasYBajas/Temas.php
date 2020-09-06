<?php

namespace App\Http\Controllers\AltasYBajas;

use App\Http\Controllers\Controller;
use App\Models\TgCurso;
use App\Models\TgGradosAcademico;
use App\Models\TgTema;
use Illuminate\Http\Request;

class Temas extends Controller
{

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
    public function create()
    {
        $variable = new TgGradosAcademico();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TgTema  $tgTema
     * @return \Illuminate\Http\Response
     */
    public function show(TgTema $tgTema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TgTema  $tgTema
     * @return \Illuminate\Http\Response
     */
    public function edit(TgTema $tgTema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TgTema  $tgTema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TgTema $tgTema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TgTema  $tgTema
     * @return \Illuminate\Http\Response
     */
    public function destroy(TgTema $tgTema)
    {
        //
    }
}
