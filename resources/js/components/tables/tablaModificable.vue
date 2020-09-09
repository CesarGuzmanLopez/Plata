<template>
	<div class="container-fluid">
        <b-form-input
            v-model="filter"
            type="search"
            id="filterInput"
            placeholder="Search"
        ></b-form-input>
		<b-table
			:items="Tabla.items"
			:fields="getfields()"
			fixed
            responsive
			:per-page="6"
			outlined
			show-empty
			small
            striped
            id="tablaprin"
            :tbody-transition-props="{name:'flip-list'}"
            sortable
            :filter="filter"
	        @filtered="onFiltered"
    	>
			<template v-slot:cell(eliminar)="Data">
				<button
					class="btn btn-primary"
					type="button"
					v-on:click="$root.$emit('bv::show::modal', 'modal'+Data.item[Tabla.fields[0]], '.btnShow');"
				>eliminar</button>
				<b-modal
					:id="'modal'+Data.item[Tabla.fields[0]]"
					@hidden="$root.$emit('bv::hide::modal', 'modal'+Data.item[Tabla.fields[0]], '.btnShow');"
					@ok="EliminarElemento(Data)"
				>Seguro que quieres eliminar el item</b-modal>
			</template>
			<template v-slot:cell(modificar)="Data" class="bg-gray">
				<button class="btn btn-primary" type="button" v-on:click="showModalActualizar(Data)">Modificar</button>
			</template>
			<template v-slot:cell()="Data">
				<div v-if="Data.value.length>15">
					<textarea class="form-control" name disabled rows="1" v-model="Data.value"></textarea>
				</div>
				<div v-else>{{ Data.value }}</div>
			</template>
		</b-table>
		<div class="row"></div>
		<!-- Modal que Recive los valores a modificar -->
		<b-modal id="ModificarModal" @ok="ModificarElemento" :title="idCambiar.toString()">
			<div v-for="(item,index) in Cambiar" :key="'CamposModificables'+index">
				<div class="form-group">
					<label for="my-input">{{index}}</label>
					<div v-if="item.tipo.toUpperCase() ==='STRING'|| item.tipo.toUpperCase() ==='STR'">
						<input
							class="form-control"
							type="text"
							:placeholder="index"
							:name="index"
							v-model="Cambiar[index].value"
						/>
					</div>
					<div v-else-if="item.tipo.toUpperCase() ==='DOUBLE' || item.tipo.toUpperCase() ==='FLOAT'">
						<input
							class="form-control"
							type="number"
							:placeholder="index"
							:name="index"
							v-model="Cambiar[index].value"
						/>
					</div>
					<div v-else-if="item.tipo.toUpperCase() ==='INTEGER' || item.tipo.toUpperCase() ==='INT' ">
						<input
							class="form-control"
							type="number"
							:placeholder="index"
							:name="index"
							v-model="Cambiar[index].value"
						/>
					</div>
					<div v-else-if="item.tipo.toUpperCase()==='BOOL' || item.tipo.toUpperCase() ==='BOOLEAN' ">
						<input
							class="form-control"
							type="checkbox"
							:placeholder="index"
							:name="index"
							v-model="Cambiar[index].value"
						/>
					</div>
					<div v-else-if="item.tipo.toUpperCase() ==='TEXT' || item.tipo.toUpperCase() ==='JSON' ">
						<textarea
							class="form-control"
							type="checkbox"
							:placeholder="index"
							:name="index"
							v-model="Cambiar[index].value"
						></textarea>
					</div>
					<div v-else>inmodificable en este contexto</div>
				</div>
			</div>
		</b-modal>

		<div class="container-fluid">
			<input type="hidden" name="_token" id="token" :value="csrf" />
			<div class="row">
				<div
					v-for="(item, index) in Tabla.fields.map((item, index)=>{  return [item,index] ; }).filter(el => !Tabla.itemsInmutables.includes(el[0]))"
					:key="'campo'+index"
					class="col"
				>
					<b>{{ item[0] }}</b>
				</div>
				<div class="col">
					<b>Añadir</b>
				</div>
			</div>
			<div class="row">
				<div
					v-for="(item, index) in Tabla.fields.map((item, index)=>{  return [item,index] ; }).filter(el => !Tabla.itemsInmutables.includes(el[0]))"
					:key="'campo'+index"
					class="col"
				>
					<div
						v-if="Tabla.tiposVariables[item[1]].toUpperCase() ==='STRING'|| Tabla.tiposVariables[item[1]].toUpperCase() ==='STR'"
					>
						<input
							class="form-control"
							type="text"
							:placeholder="item[0]"
							:name="item[0]"
							v-model="Formulario[item[0]]"
						/>
					</div>
					<div
						v-else-if="Tabla.tiposVariables[item[1]].toUpperCase() ==='DOUBLE' ||Tabla.tiposVariables[item[1]].toUpperCase() ==='FLOAT'"
					>
						<input
							class="form-control"
							type="number"
							:placeholder="item[0]"
							:name="item[0]"
							v-model="Formulario[item[0]]"
						/>
					</div>
					<div
						v-else-if="Tabla.tiposVariables[item[1]].toUpperCase() ==='INTEGER' || Tabla.tiposVariables[item[1]].toUpperCase() ==='INT' "
					>
						<input
							class="form-control"
							type="number"
							:placeholder="item[0]"
							:name="item[0]"
							v-model="Formulario[item[0]]"
						/>
					</div>
					<div
						v-else-if="Tabla.tiposVariables[item[1]].toUpperCase() ==='BOOL' || Tabla.tiposVariables[item[1]].toUpperCase() ==='BOOLEAN' "
					>
						<input
							class="form-control"
							type="checkbox"
							:placeholder="item[0]"
							:name="item[0]"
							v-model="Formulario[item[0]]"
						/>
					</div>
					<div
						v-else-if="Tabla.tiposVariables[item[1]].toUpperCase() ==='TEXT' || Tabla.tiposVariables[item[1]].toUpperCase() ==='JSON' "
					>
						<textarea
							class="form-control"
							type="checkbox"
							:placeholder="item[0]"
							:name="item[0]"
							v-model="Formulario[item[0]]"
						></textarea>
					</div>
					<div v-else>Tipo de entrada no programado aun{{ Tabla.tiposVariables[item[1]] }}</div>
				</div>
				<div class="col">
					<button class="btn btn-primary" type="button" v-on:click="enviarItems">Add</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data() {
		return {
			Tabla: {
				tiposVariables: [],
				itemsInmutables: [],
				items: [],
				fields: [],
			},
			Cambiar: {},
			idCambiar: -1,
			Formulario: {},
            Enviar: {},
            filter:"",
		};
	},
	mounted() {
		this.obtenerDatos();
	},
	props: {
		getLink: String,
		resource: String,
		csrf: String,
	},
	methods: {
		enviarItems: function () {
			this.Formulario._token = this.csrf;
			axios
				.post(this.resource, this.Formulario)
				.then((Response) => {
					this.obtenerDatos();
					this.Formulario = {};
				})
				.catch((e) => {
					console.log(e);
				});
		},
		obtenerDatos: function () {
			/**
			 * espera recibir un array de 2 elementos
			 * @var data[0] :Array tipos de variables en string
			 * @var data[1] :Array fields
			 * @var data[2] :Array items
			 * @var data[3] :Array campos que no se pueden cambiar el primero de la lista debe ser el id
			 */
			axios.get(this.getLink).then((Response) => {
				this.Tabla = {};
				this.Tabla.tiposVariables = Response.data[0];
				this.Tabla.fields = Response.data[1];
				this.Tabla.items = Response.data[2];
				this.Tabla.itemsInmutables = Response.data[3];
				this.Tabla.fields.push("modificar");
				this.Tabla.itemsInmutables.push("modificar");
				this.Tabla.fields.push("eliminar");
				this.Tabla.itemsInmutables.push("eliminar");

				this.Tabla.items.forEach((Element) => {
					Element.eliminar = true;
					Element.modificar = true;
				});
			});
		},
		showModalActualizar: function (Data) {
			var i_lista = 0;
			this.Cambiar = {};
			this.idCambiar = Data.item[this.Tabla.itemsInmutables[0]];
			for (var key in Data.item) {
				if (!this.Tabla.itemsInmutables.includes(key)) {
					this.Cambiar[key] = {};
					this.Cambiar[key].value = Data.item[key];
					this.Cambiar[key].tipo = this.Tabla.tiposVariables[i_lista];
				}
				i_lista += 1;
			}
			this.$root.$emit("bv::show::modal", "ModificarModal", ".btnShow");
		},
		ModificarElemento: function () {
			this.Enviar = {};
			for (var key in this.Cambiar) {
				this.Enviar[key] = this.Cambiar[key].value;
			}
			this.Enviar.csrf = this.csrf;
			this.Enviar._method = "PATCH";
			axios
				.post(this.resource + "/" + this.idCambiar, this.Enviar)
				.then((response) => {
					this.obtenerDatos();
				});
		},
		EliminarElemento: function (Data) {
			axios
				.post(this.resource + "/" + Data.item.id, {
					csrf: this.csrf,
					_method: "DELETE",
				})
				.then((response) => {
					this.obtenerDatos();
				});
        },
        getfields: function (){
            return this.Tabla.fields.map((item, index)=>{   return  { key: item, sortable: true} ; });
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 1
        }
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
};
</script>
<style>
    table#tablaprin .flip-list-move {
        transition: transform 1s;
    }
</style>
