@extends('layouts.app')
@section('content')
    <div id="cgt" class="p-4 m-2" urlstore="{{ route('GestorTGC.store') }}"
        urltemas="{{ route('AdministrarTemas.show', 'onlyData') }} " csrf="{{ csrf_token() }}">
        <form action="{{ route('GestorTGC.store') }}" method="post" id="TGC_env">
            @csrf
            <form-wizard :start-index="0" color="gray" title="Crear Curso"
                subtitle="Llena el formulario para crear un curso" @on-complete="submitTGC">
                <tab-content title="Agregar Curso" icon="fa fa-play" :before-change="validar1">
                    <div id="GestorCGT">
                        <div class="container">
                            <div class="row center w-auto">
                                <div class="col-12 center auto w-auto">
                                    <div class="form-group">
                                        <label for="Nombre_Curso">Nombre Curso</label>
                                        <input id="Nombre_Curso" class="form-control" placeholder="Nombre Curso" type="text"
                                            name="Nombre_Curso" v-model="Enviar.Nombre_Curso" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Descripcion_Curso">Descripcion Curso</label>
                                        <textarea id="Descripcion_Curso" class="form-control"
                                            placeholder="Descripcion Curso" type="text" name="Descripcion_Curso"
                                            v-model="Enviar.Descripcion_Curso"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="CursoPremium">Premium</label>
                                                <input type="checkbox" id="CursoPremium" class="form-control-feedback"
                                                    placeholder="Premium" type="text" v-model="Enviar.CursoPremium"
                                                    name="CursoPremium">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                <label for="Grado" class="col-md-4 col-12">Selecciona el grado</label>
                                                <select placeholder="Grado" id="Grado" class="form-control col-md-8 col-12"
                                                    name="Grado" v-model="Enviar.Grado" required>
                                                    <option></option>
                                                    @foreach ($Grados as $value)
                                                        <option value="{{ $value->id }}">{{ $value->Nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2 text-warning bg-red p-2"><a
                                                href='{{ route('AdministrarGrados.index') }}'><i
                                                    class="fa fa-upload ">Agregar
                                                    Grado </i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tab-content>
                <tab-content title="Seleccionar temas" icon="fa fa-list" :before-change="validar2">
                    <div>
                        <input v-model="filter" type="search" id="filterInput" placeholder="Type to Search">
                        <a href='{{ route('AdministrarTemas.index') }}' slot="prev" target="_blank"><i
                                class="fa fa-upload ">Agregar Temas </i> </a>
                    </div>
                    <b-table :filter="filter" sticky-header head-variant="light" hover no-border-collapse small outlined
                        borderless :items="Temas" :fields="['Nombre','Descripcion','magnitud','value']"
                        @filtered="onFiltered">
                        <template v-slot:cell(magnitud)="Data">
                            <div class="row">
                                <div class="col-8"><input type="range" v-model="Enviar.Magnitud[parseInt(Data.item.id)]"
                                        :name="'Magnitud['+parseInt(Data.item.id)+']'"></div>
                                <div class="col-4"></div>
                            </div>
                        </template>
                        <template v-slot:cell(value)="Data">
                            <label>@{{ Enviar . Magnitud[parseInt(Data . item . id)] }}</label>
                        </template>
                        <template v-slot:cell()="Data">
                            <div class="truncado">
                                @{{ Data . value }}
                            </div>
                        </template>
                    </b-table>
                </tab-content>
                <tab-content title="add Curso" icon="fa fa-circle">
                    ID Curso =@{{ idCurso }}
                </tab-content>
                <input type="hidden" slot="prev">
                <el-button class="btn btn-primary" slot="next">siguiente</el-button>
                <el-button class="btn btn-primary" slot="finish">Finalizar</el-button>
            </form-wizard>
        </form>
    </div>
@endsection
