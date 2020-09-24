@extends('layouts.app')
@section('content')
    <div id="app">
        <table-modificable v-bind:nombre-principal="'Altas y bajas de grados'" v-bind:csrf="'{{ csrf_token() }}'"
            v-bind:resource="'{{ route('AdministrarGrados.index') }}'">
        </table-modificable>
    </div>
@endsection
