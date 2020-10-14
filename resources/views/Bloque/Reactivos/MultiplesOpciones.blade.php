<div class="bg-light">
    <div class="Container-fluid">
        <div class="row">
            <div class="col  m-2 p-2">
                <div class="ml-3">
                 {!! $Pregunta !!}
                 </div>
            </div>
       </div>
    <div class="row">
            <div class="col ml-4 pl-1"">
                @if($Correctas>1)
                    <b>Selecciona las opciones correctas</b>
                @elseif($Correctas == 1)
                    <b>Selecciona la opcion correcta</b>
                @endif
            </div>
        </div>
        @foreach ($Respuestas as $clave =>  $Respuesta )
            <div class="row">
                <div class="col">
                    <div class="form-check ml-4">
                        @if($Correctas>1)
                            <input class="form-check-input" type="checkbox" name="respuesta" id="respuestaVisual{{$Respuesta->id}}" value="{{$Respuesta->id}}">
                        @elseif($Correctas == 1)
                            <input class="form-check-input" type="radio" name="respuesta" id="respuestaVisual{{$Respuesta->id}}" value="{{$Respuesta->id}}">
                        @endif
                        <label class="form-check-label" for="respuestaVisual{{$Respuesta->id}}">
                          <b>{{ chr(65+$clave) }})</b>  {!!$Respuesta->Enunciado1!!}
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
