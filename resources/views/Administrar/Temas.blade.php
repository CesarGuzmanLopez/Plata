@extends('layouts.app')
@section('content')
    <div id="TemasLista">
        <table-modificable v-bind:get-link="'{{ route('getTables/Temas') }}'" v-bind:csrf="'{{ csrf_token() }}'"
            v-bind:resource="'{{ route('AdministrarTemas.index') }}'">
        </table-modificable>
    </div>
@endsection
