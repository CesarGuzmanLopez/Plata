@extends('layouts.app')
@section('content')
    <div class="container-fluid" id="CrearReactivos" urlCurso="{{ route('AdministrarCursos.index') }}"
        csrf="{{ csrf_token() }}" urlOpciones="{{ route('AdministrarOpciones.index') }}">
        <form-wizard @on-complete="onComplete" title="Crear Reactivo" color="#C4CDC7" class="primary"
            subtitle="Llena el formulario para crear un curso">
            <tab-content title="Selecciona un curso" icon="fa fa-user" :before-change="validar1">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="Curso">Selecciona el curso</label>
                                <select id="Curso" v-on:click="selectedCurso" :change="selectedCurso" v-model="SelectCurso"
                                    class="form-control" name="Curso">
                                    <option></option>
                                    @foreach ($Cursos as $key => $Curso)
                                        <option value="{{ $Curso->id }}">{{ $Curso->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Tema">Tema</label>
                                <select id="Tema" v-model="ID_Tema" class="form-control" name="Tema">
                                    <option></option>
                                    <option :value="item.id" v-for="(item, index) in Temas">@{{ item . Nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <p v-if="ID_Grado" class="p-4 m-2"><label><b>Grado: </b> @{{ Grado }}</label></p>
                            </div>
                        </div>
                        <div class="col" v-if="SelectCurso">
                            <div class="form-group">
                                <label for="TipoPreg">Selecciona Tipo de pregunta</label>

                                <select id="TipoPreg" v-model="SelectTipoPreg" class="form-control" name="TipoPreg">
                                    @foreach ($TipoPregs as $key => $TiposPreg)
                                        <option value="{{ $TiposPreg->Nombre }}">{{ $TiposPreg->Nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <tab-content title="Crear pregunta" icon="fa fa-settings" :before-change="validar2">
                <div class="justify-content-center">
                    <template v-if=" SelectTipoPreg === 'Reactivos Multivariable'">
                        <div class="row justify-content-center">
                            <div class="col-12">
                               <div class="container-fluid">
                                   <b>Variables</b>
                                   <table class="table table-light">
                                       <thead class="thead-light">
                                           <tr>
                                               <th>Nombre Variable</th>
                                               <th>Tipo Variable</th>
                                               <th>Valores      </th>
                                               <th>*</th>
                                               <th>Eliminar</th>
                                               
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <tr v-for="(item, index) in MultiVariables.Variables">
                                                <td> @{{ item }}</td>
                                                <td>@{{MultiVariables.Tipos[index] }}</td>
                                                <td>@{{MultiVariables.Datos[index] }}</td>
                                                <td><button type="button" class="btn btn-secondary fa fa-cogs" v-on:click="AbrirModalVariable(index)" ></button></td>
                                                <td><button type="button" v-on:click="EliminarVariable(index)" class="btn btn-secondary fa fa-minus-circle"></button></td>
                                            </tr>
                                       </tbody>
                                       <tfoot>
                                           <tr>
                                            <th><input class="form-control"  size="40" maxlength="40" type="text" V-model="MuitlvariableNuevo.Variable" name="NombreVariableNueva"></th>
                                            <th><div class="form-group">
                                                    <select id="my-select" v-model="MuitlvariableNuevo.Tipo" class="form-control"  name="">
                                                        <option value="Numerico">Numerico</option>
                                                        <option value="ListaOpciones">Lista de opciones</option>
                                                        <option value="Vectores">Lista de Vectores</option>

                                                    </select>
                                                </div>
                                            </th>
                                                <th>
                                                       
                                                </th>
                                            <th>
                                                <button type="button" v-on:click="AddVariable" class="btn btn-secondary fa fa-plus"></button>
                                            </th>
                                           </tr>
                                       </tfoot>
                                   </table>
                               </div>
                            </div>
                            <div class="col">
                                <h1>Reactivo</h1>
                            <editor-tiny class="bg-white border border-black"
                                :images_upload_url="'{{ route('Gestor/uploadImagen') }}'"
                                :token="'{{ csrf_token() }}'" name="Reactivo" v-model="Reactivo"></editor-tiny>
                            </div>
                        </div>
                    </template>
                    <template v-if="SelectTipoPreg === 'Opciones multiples' ">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-10 col-xl-8">
                                <div class="text-center"> Pregunta</div>
                                <div>
                                    <editor-tiny class="bg-white border border-black"
                                        :images_upload_url="'{{ route('Gestor/uploadImagen') }}'"
                                        :token="'{{ csrf_token() }}'" name="Reactivo" v-model="Reactivo"></editor-tiny>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center p-2">
                            <div class="col-4">
                                <a class="btn btn-secondary text-light" target="_blank"
                                    href="{{ route('GestorOpciones.index') }}?tipo=OpcionesMultiples">Crear lista de
                                    respuestas</a>
                            </div>
                            <div class="col-4">
                                <button class="btn btn-secondary text-light" type="button"
                                    v-on:click="verRespuestas=!verRespuestas">Seleccionar respuestas</button>
                            </div>
                        </div>

                        <div v-if="verRespuestas" class="row  p-2">
                            <div class="col-md-4 col-12 overflow-auto" style="height: 20rem">
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <input placeholder="Filtrar listas"> <input type="checkbox"> Solo mis listas
                                </div>
                                <b-form-group label="Listas de opciones">
                                    <b-form-checkbox-group data-spy="scroll" data-offset="20" v-model="ListasActivas"
                                        :options="optionsListas" name="buttons-1" @change="ListaSelected" switches size="sm"
                                        stacked></b-form-checkbox-group>
                                </b-form-group>
                            </div>
                            <div class="col-md-8 col-12 p-0">
                                <table class="table p-0 m-0 table-sm table-light table-striped">
                                    <template v-for="(Activo) in ListasActivas">
                                        <thead class="thead-dark p-0 mt-2">
                                            <tr>
                                                <th scope="col"><input type="checkbox" :id="'Lista_'+Activo"
                                                        v-model="SeleccionarTodaLista[Activo]"
                                                        v-on:click="SeleccionarTodosLista(Activo)"> </th>
                                                <th scope="col"><label :for="'Lista_'+Activo">
                                                        @{{ NombresDeListas[Activo] }}<label>
                                                </th>
                                                <th scope="col">
                                                    correctas
                                                    <div class="">
                                                        <input type="checkbox" :id="'Lista_'+Activo"
                                                            v-model="SeleccionarTodasCorrectasLista[Activo]"
                                                            v-on:click="SeleccionarTodasCorrectas(Activo)"
                                                            :disabled="!SeleccionarTodaLista[Activo]" class="form-control">
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr :class="(opcionesSeleccionadas[Elemento] &&ValorRespuestas[Elemento] ) ?'bg-success':(opcionesSeleccionadas[Elemento])?'bg-danger':''"
                                                v-for="Elemento in ElementosEnLista[Activo]" :for="'Resp_'+Activo">
                                                <td :for="'Resp_'+Elemento"><input type="checkbox" ff3434
                                                        v-model="opcionesSeleccionadas[Elemento]" class="my-auto"
                                                        :id="'Resp_'+Elemento"></td>
                                                <td>
                                                    <label class="row m-0" :for="'Resp_'+Elemento">
                                                        <div class="col-10 bg-white p-2 m-0"
                                                            v-html="EnunciadosRespuestas[Elemento].substr(0,45)"></div>
                                                        <div class="col-1 p-2 m-0"><button class="bg-aqua"
                                                                @click="showOpcion(Elemento)"><i class="fa fa-eye"
                                                                    aria-hidden="true"></i></button>
                                                        </div>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div>
                                                        <input class="form-control  my-auto" type="checkbox"
                                                            v-model="ValorRespuestas[Elemento]"
                                                            :disabled="!opcionesSeleccionadas[Elemento]">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </template>
                                </table>
                            </div>
                        </div>
                        <b-modal ref="my-modal-opcion" hide-footer title="Enunciado Respuesta Actual">
                            <div v-html="EnunciadosRespuestas[verOpcion]"></div>
                        </b-modal>
                    </template>
                </div>
            </tab-content>
            <tab-content title="Retroalimentacion" icon="fa fa-check" :before-change="validar3">
                <h1 class="text-center">Retroalimentación</h1>
                <editor-tiny class="bg-white border border-black" :images_upload_url="'{{ route('Gestor/uploadImagen') }}'"
                    :token="'{{ csrf_token() }}'" name="Reactivo" v-model="Retroalimentacion"></editor-tiny>
            </tab-content>
            <tab-content title="Previsualizacion" icon="fa fa-outdent">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <label for="NumCorrectas">Numero de repuestas correctas</label>
                            <input type="number" id="NumCorrectas" v-model="NumCorrectas" name="NumCorrectas" min="1"
                                :max="TotalNumeroCorrectas">
                        </div>
                        <div class="col">
                            <label for="NumIncorrectas">Numero de repuestas incorrectas</label>
                            <input type="number" id="NumIncorrectas" v-model="NumIncorrectas" name="NumIncorrectas" min="1"
                                :max="TotalIncorrectas">
                        </div>
                        <div class="col">
                            <button class="btn btn-success" type="button" v-on:click="PrevisualizarMultiple">Previsualizar
                                aleatorio</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col overflow-auto" v-html="Previsualizacion"> </div>
                    </div>
                </div>
            </tab-content>
        </form-wizard>

        <b-modal ref="modal-variable" hide-footer title="Pregunta">
            <template >

            </template>
        </b-modal>
    </div>
    <!-- div class="row">
        <div class="col p-2 bg-primary">primary</div>
        <div class="col p-2 bg-secondary">secundaty</div>
        <div class="col p-2 bg-info">info</div>
        <div class="col p-2 bg-warning">warning</div>
        <div class="col p-2 bg-success">succes</div>
        <div class="col p-2 bg-danger">danger</div>
    </div -->
@endsection
