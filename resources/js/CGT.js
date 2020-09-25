if ($("#cgt").length != 0) app = new Vue({
    el: '#cgt',
    beforeMount: function () {
        this.LinkTemas = this.$el.attributes.urltemas.value;
        this.urlstore = this.$el.attributes.urlstore.value;
        this.Enviar.csrf = this.$el.attributes.csrf.value;
    },
    data() {
        return {
            LinkTemas: "",
            urlstore: "",
            filter: null,
            Temas: [],
            idCurso: null,
            Enviar: {
                Nombre_Curso: "",
                Descripcion_Curso: "",
                Magnitud: [],
                CursoPremium: "",
                Grado: "",
                csrf: null,
            }
        };
    },
    mounted() {

    },
    computed: {
        sortOptions() {
            return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return {
                        text: f.label,
                        value: f.key
                    };
                });
        }
    },
    methods: {
        submitTGC() {

        },
        validar2() {
            axios.post(this.urlstore, this.Enviar).then((Response) => {
                this.idCurso = Response.data;
            }).catch( error => {
                    alert(error);
            });
            return true;
        },
        validar1() {
            axios.get(this.LinkTemas).then((Response) => {
                this.Temas = Response.data;
                this.Temas.forEach((valor) => {
                    this.Enviar.Magnitud[valor.id] = this.Enviar.Magnitud[valor.id] ? this.Enviar.Magnitud[valor.id] : "0";
                });
            });
            return true;
        },
        onFiltered(filteredItems) {
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        }
    }
});
