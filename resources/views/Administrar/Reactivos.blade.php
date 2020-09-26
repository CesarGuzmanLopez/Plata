@extends('layouts.app')
@section('content')
    <div id="app">
        <table-modificable v-bind:nombre-principal="'Altas y bajas de Reactivos'" v-bind:csrf="'{{ csrf_token() }}'"
            v-bind:resource="'{{ route('AdministrarReactivos.index') }}'"
            v-bind:images_upload_url="'{{route('Gestor/uploadImagen')}}'">
        </table-modificable>
    </div>
@endsection
