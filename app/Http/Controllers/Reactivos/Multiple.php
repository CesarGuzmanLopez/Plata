<?php

namespace App\Http\Controllers\Reactivos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReactivosOpcione;
use View;

class Multiple extends Controller
{
    public function __invoke(Request $request){
      //  return ($request->Respuestas);
        $data = [
            "Pregunta" =>$request->Pregunta,
            "Respuestas"    => ReactivosOpcione::whereIn('id', $request->Respuestas)->inRandomOrder()->get(),
            'Correctas'     =>$request->Correctas,
            'Incorrectas'   =>$request->Incorrectas,

        ];
        return view("Bloque.Reactivos.MultiplesOpciones")->with($data);
    }
}
