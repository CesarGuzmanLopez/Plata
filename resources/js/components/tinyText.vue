<template>
	<editor
		:name="name"
		v-model="valor"
		:placeholder="name"
		api-key="y384aesqbqgvxfvpzzc4i6h5sujdgwsxf4gf7uajcr2o2tkv"
		pla
		:init="configurarInit"
		@input="handleInput"
	>
	</editor>
</template>
<script>
export default {
	components: {
		editor: Editor,
	},
	props: {
		name: String,
		value: String,
		images_upload_url: String,
		token: String,
	},
	methods: {
		images_upload_handler(blobInfo, success, failure) {
			var formData = new FormData();
			formData.append("file", blobInfo.blob(), blobInfo.filename());
			formData.append("csrf", this.token);
			try {
				axios.post(this.images_upload_url, formData).then((response) => {
					success(response.data);
				});
			} catch (e) {
				failure("HTTP Error: " + e);
			}
		},
		handleInput(e) {
			this.$emit("input", this.valor);
		},
	},
	data() {
		return {
			valor: this.value,
			configurarInit: {
				selector: this.name,
				external_plugins: {
					mathjax: "/js/plugins/tinymce-mathjax/plugin.js",
					tiny_mce_wiris:
						"https://www.wiris.net/demo/plugins/tiny_mce/plugin.js",
				},
				mathjax: {
					lib: "/js/app.js",
				},
				inline: true,
				tabfocus_elements: ":prev,:next",
				menubar:
					"edit insert code view format table toc tools wordcount insert ",
				toolbar:
					"forecolor backcolor code charmap visualblocks insert hr tabfocus toc media numlist bullist importcss emoticons preview mathjax  tiny_mce_wiris_formulaEditorChemistry",
				plugins:
					"table image  code visualblocks codesample advlist directionality  tabfocus media lists imagetools  emoticons autolink  charmap preview template wordcount  mathjax  autoresize hr",
				branding: false,
				entity_encoding: "raw",
				add_unload_trigger: false,
				remove_linebreaks: false,
				apply_source_formatting: false,
				images_upload_url: this.images_upload_url,
				token: this.token,
				images_upload_handler: this.images_upload_handler,
			},
		};
	},
};
</script>

<style>
</style>