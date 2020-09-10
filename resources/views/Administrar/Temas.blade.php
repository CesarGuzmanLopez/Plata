@extends('layouts.app')
@section('content')
    <div id="app">
        <table-modificable v-bind:csrf="'{{ csrf_token() }}'" v-bind:resource="'{{ route('AdministrarTemas.index') }}'">
        </table-modificable>
    </div>
@endsection
