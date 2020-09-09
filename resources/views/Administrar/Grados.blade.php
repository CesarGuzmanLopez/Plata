@extends('layouts.app')
@section('content')
    <div id="TemasLista">
        <table-modificable
            v-bind:get-link="'{{ route('getTables/Grados') }}'" v-bind:csrf="'{{ csrf_token() }}'"
            v-bind:resource="'{{ route('AdministrarGrados.index') }}'">
        </table-modificable>
    </div>
@endsection
