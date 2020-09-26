

window.Vue = require('vue');
window.Editor = global.Editor = Editor;

import 'jquery-ui/ui/widgets/datepicker.js';
import BootstrapVue from 'bootstrap-vue';
import Editor from '@tinymce/tinymce-vue';
import 'mathjax/es5/tex-chtml-full';
import VueFormWizard from 'vue-form-wizard';
import 'vue-form-wizard/dist/vue-form-wizard.min.css';

window.$ = window.jQuery = $ = global.$ = global.jQuery = require('jquery');
Vue.use(VueFormWizard);
Vue.use(Editor);
Vue.use(BootstrapVue);


require('tinymce');
require('./bootstrap');
require('venobox/venobox/venobox.min.js').default; //jshint ignore:line
require('./Princpal');
require('./CGT.js');

Vue.component('editor-tiny',require('./components/tinyText.vue').default);
Vue.component('table-modificable', require('./components/tables/tablaModificable.vue').default);
if ($("#app").length != 0) var app = new Vue({
    el: '#app',
});