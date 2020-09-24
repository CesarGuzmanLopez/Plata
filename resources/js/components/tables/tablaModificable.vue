<template>
	<div class="container-fluid p-2">
       <div class="" >
        <div class="text-center" > <b>{{NombrePrincipal}}</b></div>
        </div>
        <div class="form-group">
            <label for="filterInput">Buscar en tabla</label>
            <input v-model="filter" type="search" class="form-control-feedback" id="filterInput" placeholder="Buscar">
        </div>
        <b-table
			:items="Tabla.items"
			:fields="getfields()"
			fixed
			responsive
			:per-page="6"
			outlined
			show-empty
			small
			:current-page="currentPage"
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
				<div v-if="SubtablasConfiguracion.find(element => element.nombreCampo ===Data.field.key)">
					<button
						class="btn btn-primary"
						type="button"
						v-on:click="showModalLista(Data)"
					>{{ Data.field.key}}</button>
				</div>
				<div v-else-if="Data.value.length>15">
					<textarea class="form-control" name disabled rows="1" v-model="Data.value"></textarea>
				</div>
				<div v-else>{{ Data.value }}</div>
			</template>
		</b-table>

		<b-col sm="7" md="6" class="my-1">
			<b-pagination
				v-model="currentPage"
				:total-rows="totalRows"
				:per-page="6"
				align="fill"
				size="sm"
				class="my-0"
			></b-pagination>
		</b-col>

		<b-modal
			@ok="EditarRelacionValores"
			:title="ModalConnection.title"
			size="xl"
			id="ModalListaDifuso"
			ref="ModalListaDifuso"
		>
			<div class="row">
				<div class="col-12 col-md-8">
					<b-table
						:items="ModalConnection.tabla.elementos"
						fixed
						responsive
						:per-page="6"
						:filter="ModalConnection.tabla.filter"
						outlined
						show-empty
						small
						:current-page="ModalConnection.tabla.currentPage"
						striped
						id="TablaDifusa"
						:tbody-transition-props="{name:'flip-list'}"
					>
						<template v-slot:cell()="Data">
							<div class="truncado">{{ Data.value }}</div>
						</template>
						<template v-slot:cell(Valor)="Data">
							<div class="row">
								<input
									list="tickmarks"
									class="form-control col-12"
									type="range"
									v-model="ModalConnection.valores[Data.item.id]"
								/>

								<div class="col-12">
									<input type="number" class="form-control" v-model="ModalConnection.valores[Data.item.id]" />
								</div>
							</div>
						</template>
					</b-table>
					<b-pagination
						v-model="ModalConnection.tabla.currentPage"
						:total-rows="ModalConnection.tabla.totalRows"
						:per-page="6"
						align="fill"
						size="sm"
						class="my-0"
					></b-pagination>
				</div>
			</div>
		</b-modal>
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
					<div v-else-if="item.tipo.toUpperCase() ==='TEXT' ">
						<textarea
							class="form-control"
							type="checkbox"
							:placeholder="index"
							:name="index"
							v-model="Cambiar[index].value"
						></textarea>
					</div>
					<div v-else-if="item.tipo.toUpperCase() ==='JSON'">
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
		<div class="container-fluid bg-secondary py-4 rounded-sm">
			<div class="container">
				<div
					v-for="(item, index) in Tabla.fields.map((item, index)=>{  return [item,index] ; }).filter(el => !Tabla.itemsInmutables.includes(el[0]))"
					:key="'campo'+index"
					class="row py-2"
				>
					<div class="col-3">
						<label>
							<b>{{item[0]}}</b>
						</label>
					</div>
					<div class="col-9">
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
						<div v-else-if="Tabla.tiposVariables[item[1]].toUpperCase() ==='TEXT' ">
							<textarea
								class="form-control"
								type="checkbox"
								:placeholder="item[0]"
								:name="item[0]"
								v-model="Formulario[item[0]]"
							></textarea>
						</div>
						<div v-else-if="Tabla.tiposVariables[item[1]].toUpperCase() ==='JSON' ">
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
	/**`
	 * @var resource : Link principal de controller of resources
	 * @var csrf
	 * @access
	 * */

	props: {
		resource: String,
		NombrePrincipal: String,
		csrf: String,
	},
	data() {
		return {
			contieneSubTabla: false,
			Tabla: {
				tiposVariables: [],
				itemsInmutables: [],
				items: [],
				fields: [],
			},
			ModalConnection: {
				NombreTabla: "",
				title: "",
				tabla: {
					elementos: "",
					labels: "",
					filter: "",
					currentPage: 1,
					totalRows: 0,
				},
				indice: -1,
				activos: [],
				valores: [],
				NombreID: "",
			},
			SubtablasConfiguracion: [],
			Cambiar: {},
			idCambiar: -1,
			Formulario: {},
			currentPage: 1,
			Enviar: {},
			filter: "",
			totalRows: 0,
			datacollection: null,
		};
	},
	mounted() {
		this.obtenerDatos();
	},
	methods: {
		EditarRelacionValores() {
			this.Enviar = {};
			this.Enviar.update = this.ModalConnection.NombreTabla;
			this.Enviar.csrf = this.csrf;
			this.Enviar._method = "PATCH";
			this.Enviar.relacionValor = this.ModalConnection.valores;
			axios
				.post(this.resource + "/" + this.ModalConnection.indice, this.Enviar)
				.then((response) => {
					this.obtenerDatos();
				});
		},
		enviarItems() {
			this.Formulario._token = this.csrf;
			this.filter =
				"" +
				this.Formulario[
					this.Tabla.fields.filter(
						(el) => !this.Tabla.itemsInmutables.includes(el)
					)[0]
				];

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
		obtenerDatos() {
			/**
			 * espera recibir un array de 2 elementos
			 * @var data[0] :Array tipos de variables en string
			 * @var data[1] :Array fields
			 * @var data[2] :Array items
			 * @var data[3] :Array campos que no se pueden cambiar el primero de la lista debe ser el id
			 * @var data[4] :{String Elemento conectado A tabla}
			 * @var data[5] :{Array Elemntos de la tabla}
			 */
			axios.get(this.resource + "/all").then((Response) => {
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
				if (Response.data[4]) {
					this.SubtablasConfiguracion = [];
					this.contieneSubTabla = true;
					Response.data[4].forEach((subtabla) => {
						var nuevo = {};
						nuevo.nombreID = subtabla[0];
						nuevo.nombreCampo = subtabla[1];
						nuevo.tipoRelacion = subtabla[2];
						nuevo.url = subtabla[3];
						this.SubtablasConfiguracion.push(nuevo);
						this.Tabla.fields.push(nuevo.nombreCampo);
						this.Tabla.itemsInmutables.push(nuevo.nombreCampo);
						this.Tabla.items.forEach((Element) => {
							Element[nuevo.nombreCampo] = true;
						});
					});
				} else this.contieneSubTabla = false;
				this.totalRows = this.Tabla.items.length;
			});
		},
		showModalActualizar(Data) {
			var i_lista = 0;
			this.Cambiar = {};
			this.idCambiar = Data.item[this.Tabla.itemsInmutables[0]];
			for (var key in Data.item) {
				if (!this.Tabla.itemsInmutables.includes(key)) {
					this.Cambiar[key] = {};
					this.Cambiar[key].value = Data.item[key];
					if (this.Tabla.tiposVariables[i_lista].toUpperCase() === "JSON") {
						this.Cambiar[key].value = JSON.parse(this.Cambiar[key].value);
					}
					this.Cambiar[key].tipo = this.Tabla.tiposVariables[i_lista];
				}
				i_lista += 1;
			}
			this.$root.$emit("bv::show::modal", "ModificarModal", ".btnShow");
		},
		ModificarElemento() {
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
		EliminarElemento(Data) {
			axios
				.post(this.resource + "/" + Data.item.id, {
					csrf: this.csrf,
					_method: "DELETE",
				})
				.then((response) => {
					this.obtenerDatos();
				});
		},
		getfields() {
			return this.Tabla.fields.map((item, index) => {
				var vara = "none";
				if (
					this.SubtablasConfiguracion.find(
						(element) => element.nombreCampo === item
					)
				)
					vara = "warning";
				return { key: item, sortable: true, variant: vara };
			});
		},
		onFiltered(filteredItems) {
			// Trigger pagination to update the number of buttons/pages due to filtering
			this.totalRows = filteredItems.length;
			this.currentPage = 1;
		},
		showModalLista(Data) {
			let datosConsulta = {};
			let indice = 0;
			var DatosResponseRelacion;
			var TodasOpciones;

			this.SubtablasConfiguracion.forEach((element, index) => {
				if (Data.field.key === element.nombreCampo) {
					datosConsulta = element;
					indice = index;
				}
			});
			this.ModalConnection.title = this.NombrePrincipal + " ->Editar" + Data.field.key;
			this.ModalConnection.NombreTabla = datosConsulta.nombreCampo;
			this.ModalConnection.NombreID = datosConsulta.nombreID;
			this.ModalConnection.totalRows = 0;
			this.ModalConnection.currentPage = 1;
			this.ModalConnection.indice = Data.item.id;

			/**
			 * obtengo los datos del elemento que estan relacionados
			 */
			axios
				.all([
					axios.get(this.resource + "/" + Data.item.id), //Datos del elemento echo click
					axios.get(datosConsulta.url), //Todas las opciones
				])
				.then((response) => {
					this.ModalConnection.activos = response[0].data[indice];
					this.ModalConnection.tabla.elementos = response[1].data;
					this.Escojemodal(datosConsulta);
				});
		},
		Escojemodal(datosConsulta) {
			switch (datosConsulta.tipoRelacion.toUpperCase()) {
				case "DIFUSO":
					this.ModalConnection.tabla.totalRows = 0;

					this.ModalConnection.tabla.elementos.forEach((element, index) => {
						element.Valor = true;
						this.ModalConnection.valores[element.id] = 0;
						this.ModalConnection.tabla.totalRows += 1;
					});
					this.ModalConnection.activos.forEach((element) => {
						this.ModalConnection.valores[
							element[this.ModalConnection.NombreID]
						] = element.valor;
					});
					this.$root.$emit("bv::show::modal", "ModalListaDifuso", ".btnShow");
					break;
			}
		},
	},
	computed: {
		sortOptions() {
			// Create an options list from our fields
			return this.fields
				.filter((f) => f.sortable)
				.map((f) => {
					return { text: f.label, value: f.key };
				});
		},
	},
};
/**
 * @var integer
 */
</script>
<style>
table#tablaprin .flip-list-move {
	transition: transform 1s;
}
.truncado {
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
}
</style>
