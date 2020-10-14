if ($("#gestorOpciones").length != 0) {


   
    app = new Vue({
        el: '#gestorOpciones',
        data() {
            return {
                Links: {
                    Curso: "",
                    Opciones: "",
                },
                csrf: "",
                ID_Tipo: "",
                Grado: null,
                SelectCurso: 0,
                SelectTipoPreg: null,
                Reactivo: "",
                ListasRespuestas: [],
                ListasActivas: [],
                Respuestas: {
                    AddResp: 0,
                    NumRespuestas: 1,
                    NombreLista: "",
                    Respuestas: []
                },
                ID_select_Preguntas_Echas: [],
                optionsListas: [

                ],
                RespuestasDescargadas  : [],
                IDs_Listas_Descargadas : [],
                ID_Listas_Seleccionadas: [],
                Elementos_ContineListas: [],
                Elementos              : [],
                Elementos_Seleccionados: [],
            };
        },
        components: {
            'editor': Editor,
        },
        beforeMount() {
            this.Links.Curso = this.$el.attributes.urlcurso.value;
            this.Links.Opciones = this.$el.attributes.urlopciones.value;
            this.csrf = this.$el.attributes.csrf.value;
            this.ID_Tipo = this.$el.attributes.idtipo.value;
        },
        mounted: function () {
            this.descargaRespuestas();
        },
        methods: {
            descargaRespuestas() {
                axios.get(this.Links.Opciones + "/ListasOpcionesMultiples").then((response) => {
                    this.ListasRespuestas = response.data;
                    this.ListasRespuestas.forEach(element => {
                        this.optionsListas.push({
                            text: element.Nombre,
                            value: element.id,
                            style: "margin: 5px;"
                        });
                    });
                    
                });
            },
            onComplete() {
            },
            addNumrespuesta() {
                this.Respuestas.Respuestas.push("");

            },

            EnivarRespuestas() {
                Enviar = {};
                Enviar.Datos = this.Respuestas.Respuestas;
                Enviar.Todo = "Multiple";
                Enviar.csrf = this.csrf;
                Enviar.NombreLista = this.Respuestas.NombreLista;
                Enviar.ID_Tipo_Pregunta = this.ID_Tipo;
                Enviar.Respuestas_Seleccionadas = this.ID_select_Preguntas_Echas;
                try {
                    axios.post(this.Links.Opciones, Enviar).then((Response) => {
                        this.Respuestas.Respuestas = [];
                        this.Respuestas.NombreLista = "";
                        this.descargaRespuestas();
                    }).then((request) => {
                        console.log(requeset);
                    });
                } catch (e) {

                }
            },
            ListaSelected(contenido) {
                axios.get(this.Links.Opciones + "/OpcinesEnIDLista?idlista=" +
                    contenido[contenido.length - 1]).then((response) => {
                    Vue.set(this.RespuestasDescargadas, contenido[contenido.length - 1], response.data);
                });
            },


        }
    });
}
