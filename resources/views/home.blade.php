@extends('layouts.app')

@section('content')
    <div class="contanier-fluid">
        <div class="d-flex flex-nowrap">
            <div class="d-flex align-items-end flex-column bd-highlight mb-3" >
                <div class=""><h3>Tablas</h3></div>
                <div class="mb-auto p-2 bd-highlight">      </div>
                <div class="p-2 bd-highlight"><a href="{{ route("AdministrarCursos.index") }}"   >Altas y Bajas Cursos</a></div>
                <div class="p-2 bd-highlight"><a href="{{ route("AdministrarGrados.index") }}"   >Altas y Bajas Grados</a></div>
                <div class="p-2 bd-highlight"><a href="{{ route("AdministrarOpciones.index") }}" >Altas y Bajas Opciones</a></div>
                <div class="p-2 bd-highlight"><a href="{{ route("AdministrarReactivos.index") }}">Altas y Bajas Reactivos</a></div>
                <div class="p-2 bd-highlight"><a href="{{ route("AdministrarTemas.index") }}"    >Altas y Bajas Temas</a></div>
            </div>
            <div class="container" >
     
            </div>
        </div>
    </div>
@endsection
