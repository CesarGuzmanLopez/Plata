@extends('layouts.app')
@section('content')
    <div id="app">
        <table-modificable v-bind:nombre-principal="'{{ $Titulo }}'" v-bind:csrf="'{{ csrf_token() }}'"
            v-bind:resource="'{{ $Ruta }}'"
            v-bind:images_upload_url="'{{route('Gestor/uploadImagen')}}'">
        </table-modificable>
    </div>
@endsection
