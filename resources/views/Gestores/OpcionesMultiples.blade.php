@extends('layouts.app')
@section('content')
    <div class="container" id="gestorOpciones" urlCurso="{{ route('AdministrarCursos.index') }}" idtipo="{{ $ID_Tipo }}"
        csrf="{{ csrf_token() }}" urlOpciones="{{ route('GestorOpciones.index') }}">
        <div class="row">
            <div class="form-group col">
                <label for="ListaRespuesta">Nombre de la lista</label>
                <input id="ListaRespuesta" class="form-control" type="text" v-model="Respuestas.NombreLista">
            </div>
        </div>
        <div class="row">
            <div class=" col-12 col-md-8 border border-aqua border-top ">
                <div v-for="(item, index) in Respuestas.Respuestas">
                    Respuesta No.@{{ index }}
                    <editor-tiny class="bg-white border border-black"
                        :images_upload_url="'{{ route('Gestor/uploadImagen') }}'" :token="'{{ csrf_token() }}'"
                        :name="'respuesta['+index+']'" v-model="Respuestas.Respuestas[index]"></editor-tiny>
                </div>
                <div v-for="(itemActivo) in ListasActivas">
                    <div v-for="(item,index) in RespuestasDescargadas[itemActivo]" class="m-2 p-2 border border-maroon">
                        <div class="container-fluid m-0 p-0">
                            <input :id="'itemLista_'+item.id" class="form-check-input  border-aqua"
                                v-model="ID_select_Preguntas_Echas[item.id]" type="checkbox">
                            id @{{ item . id }}
                            <label :for="'itemLista_'+item.id" class="form-check-label container-fluid border-danger ">
                                <div v-html="item.Enunciado1" style="background-color:#ecf2f6; "></div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col my-auto">
                    <button class="btn btn-dark m-2" v-on:click="addNumrespuesta">Agregar Respuesta</button>
                </div>
            </div>
            <div class=" col-12 col-md-4 border border-aqua border-top ">
                <div data-spy="scroll" data-offset="20">
                    <b-form-group label="Listas de opciones">
                        <b-form-checkbox-group v-model="ListasActivas" :options="optionsListas" name="buttons-1"
                            @change="ListaSelected" switches size="sm" stacked></b-form-checkbox-group>
                    </b-form-group>
                </div>
            </div>
        </div>
        <button class="btn btn-success m-2" v-on:click="EnivarRespuestas">Enviar Grupo</button>

    </div>
@endsection
