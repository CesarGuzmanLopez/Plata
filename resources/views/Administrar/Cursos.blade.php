@extends('layouts.app')
@section('content')
    <div id="TemasLista">
        <table-modificable v-bind:get-link="'{{ route('getTables/Cursos') }}'" v-bind:csrf="'{{ csrf_token() }}'"
            v-bind:resource="'{{ route('AdministrarCursos.index') }}'">
        </table-modificable>
    </div>
@endsection
