@extends('layouts.app')
@section('content')
    <div id="app">
        <table-modificable v-bind:nombre-principal="'Altas y bajas de Cursos'" v-bind:csrf="'{{ csrf_token() }}'"
            v-bind:resource="'{{ route('AdministrarCursos.index') }}'">
        </table-modificable>
    </div>
@endsection
