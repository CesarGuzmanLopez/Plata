<?php
namespace App\Http\Controllers\Gestores;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UploadImagen extends Controller
{

    public function __invoke(Request $request){
        return asset(Storage::url($request->file('file')->store('public/Imagenes/Rdn')));
    }

}
