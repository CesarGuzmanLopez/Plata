if ($("#CrearReactivos").length != 0) {
    app =
        new Vue({
            el: '#CrearReactivos',

            data() {
                return {
                    Links: {
                        Curso: "",
                        Opciones: "",
                    },
                    Retroalimentacion: null,
                    Temas: [],
                    data: '',
                    csrf: "",
                    Grado: null,
                    SelectCurso: 0,
                    ID_Grado: null,
                    ID_Tema: null,
                    ID_Tipo: null,
                    SelectTipoPreg: null,
                    Reactivo: "",
                    ListasRespuestas: [],
                    ListasActivas: [],
                    ElementosEnLista: [{}],
                    NombresDeListas: [],
                    verRespuestas: false,
                    Respuestas: {
                        AddResp: 0,
                        NumRespuestas: 1,
                        NombreLista: "",
                        Respuestas: [""]
                    },
                    verOpcion: null,
                    optionsListas: [

                    ],
                    EnunciadosRespuestas: [],
                    opcionesSeleccionadas: [],
                    SeleccionarTodaLista: [],
                    
                    SeleccionarTodasCorrectasLista: [],
                    ValorRespuestas: [],
                    Previsualizacion:"",
                    TotalNumeroCorrectas:0,
                    TotalIncorrectas:0,
                    NumCorrectas:0,
                    NumIncorrectas:0,
                };

            },
            components: {
                'editor': Editor,
            },
            computed: {

            },
            beforeMount() {
                this.Links.Curso = this.$el.attributes.urlcurso.value;
                this.Links.Opciones = this.$el.attributes.urlopciones.value;
                this.csrf = this.$el.attributes.csrf.value;
            },
            mounted: function () {
                //	/** @deprecated**/
                //debe estar activado js para que funcione los datos los scara del archivo
                //blade en el que se declara este archivo blade es
                //Reactivos/CrearReactivo
                //	this.data = DatosApp;
                //	console.log(this.data);

            },
            methods: {
                onComplete() {

                },
                validar1: function () {
                    if (this.SelectTipoPreg == null)
                        return false;
                    try {
                        axios.get(this.Links.Opciones + "/ListasOpcionesMultiples").then((response) => {
                            this.ListasRespuestas = response.data;
                            this.ListasRespuestas.forEach(element => {
                                this.optionsListas.push({
                                    text: element.Nombre,
                                    value: element.id,
                                    style: "margin: 5px;"
                                });
                                this.NombresDeListas[element.id] = element.Nombre;
                                this.SeleccionarTodaLista[element.id] = false;
                                this.SeleccionarTodasCorrectasLista[element] = false;
                            });

                        });
                    } catch (e) {

                    }
                    return true;
                },
                validar2(){
                    this.TotalNumeroCorrectas=0;
                    this.TotalIncorrectas=0;
                    this.opcionesSeleccionadas.forEach((elemento,index)=>{
                        if(elemento && this.ValorRespuestas[index])
                           this.TotalNumeroCorrectas = 1+this.TotalNumeroCorrectas;
                        else
                            this.TotalIncorrectas = 1+this.TotalIncorrectas;
                    });
                    return (this.TotalIncorrectas>0 &&  this.TotalNumeroCorrectas >0)&& (this.Reactivo.length>0) ;
                },
                validar3(){
                     this.Previsualizacion="";
                    return true;
                },
                ListaSelected(contenido) {

                    try {
                        axios.get(this.Links.Opciones + "/OpcinesEnIDLista?idlista=" +
                            contenido[contenido.length - 1]).then((response) => {
                            //   console.log(response.data);
                            elemetosEnLista = [];
                            response.data.forEach(element => {
                                Vue.set(this.EnunciadosRespuestas, element.id, element.Enunciado1);
                                elemetosEnLista.push(element.id);
                                this.opcionesSeleccionadas[element.id] = false;
                                this.ValorRespuestas[element.id] = false;
                            });
                            Vue.set(this.ElementosEnLista, contenido[contenido.length - 1], elemetosEnLista);
                        });
                    } catch (e) {

                    }

                },

                selectedCurso() {
                    if (this.SelectCurso == null || this.SelectCurso == 0) return;
                    this.Temas = [];
                    this.ID_Grado = null;
                    this.ID_Tema = null;
                    this.SelectTipoPreg = null;
                    try {
                        axios
                            .all([
                                axios.get(this.Links.Curso + "/Temas?id=" + this.SelectCurso),
                                axios.get(this.Links.Curso + "/Grado?id=" + this.SelectCurso)
                            ]).then((Response) => {
                                this.Temas = Response[0].data;
                                this.ID_Grado = Response[1].data.id;
                                this.Grado = Response[1].data.Nombre;
                            });
                    } catch (e) {}
                },
                SeleccionarTodosLista(conte) {
                    Vue.set(this.SeleccionarTodaLista, conte, !this.SeleccionarTodaLista[conte]);
                    if (this.SeleccionarTodaLista[conte]) {
                        this.ElementosEnLista[conte].forEach(element => {
                            Vue.set(this.opcionesSeleccionadas, element, true);
                        });
                    } else {
                        this.ElementosEnLista[conte].forEach(element => {
                            Vue.set(this.opcionesSeleccionadas, element, false);
                        });
                    }
                },
                showOpcion(conte) {
                    this.verOpcion = conte;
                    this.$refs['my-modal-opcion'].show();
                },

                SeleccionarTodasCorrectas(conte) {
                    Vue.set(this.SeleccionarTodasCorrectasLista, conte, !this.SeleccionarTodasCorrectasLista[conte]);
                    if (this.SeleccionarTodasCorrectasLista[conte]) {
                        this.ElementosEnLista[conte].forEach(element => {
                            Vue.set(this.ValorRespuestas, element, true);
                        });
                    } else {
                        this.ElementosEnLista[conte].forEach(element => {
                            Vue.set(this.ValorRespuestas, element, false);
                        });
                    }
                },
                PrevisualizarMultiple() {
                    console.log("Sirve");
                    var TodasRespuestas=[];
                    var CorrectasAenviar;
                    var NumCorrectas    =this.NumCorrectas;
                    var NumIncorrectas  =this.NumIncorrectas;
                    var aenviar=[];
                    this.opcionesSeleccionadas.forEach((elemento,index)=>{
                        if(elemento) TodasRespuestas.push(index);
                    });
                    while(NumCorrectas > 0 || NumIncorrectas>0 ){
                        NumAleatorio = Math.floor(Math.random()*(TodasRespuestas.length));
                        if(this.ValorRespuestas[TodasRespuestas[NumAleatorio]] && NumCorrectas>0 ){
                            NumCorrectas = NumCorrectas-1;
                            aenviar.push(TodasRespuestas[NumAleatorio]);
                        }else if(!this.ValorRespuestas[TodasRespuestas[NumAleatorio]] && NumIncorrectas>0){
                            NumIncorrectas=NumIncorrectas-1;
                            aenviar.push(TodasRespuestas[NumAleatorio]);
                        }
                        TodasRespuestas.splice(NumAleatorio, 1);
                    }
                    data ={
                        '_token':this.csrf,
                        'Respuestas' :aenviar,
                        "Pregunta"   :this.Reactivo,
                        "Correctas"  :this.NumCorrectas,
                        "Incorrectas":this.NumIncorrectas
                        };
                    try{
                        axios.post('/Reactivo/Multiple',data).then(
                            (response)=>{
                                this.Previsualizacion=response.data;
                            }
                        );
                    }catch(e){
                        this.Previsualizacion="<b class=\"bg-danger\">Hubo un error al tratar de visualizar</b>";
                    }
                },
            }
        });
}
