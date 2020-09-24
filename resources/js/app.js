import 'jquery-ui/ui/widgets/datepicker.js';
import BootstrapVue from 'bootstrap-vue';
import Editor from '@tinymce/tinymce-vue';
import 'mathjax/es5/tex-chtml-full';

window.$ = window.jQuery = $;
global.$ = global.jQuery = require('jquery');
window.Vue = require('vue');
window.Editor = global.Editor = Editor;

require('tinymce');
require('./bootstrap');
require('venobox/venobox/venobox.min.js').default; //jshint ignore:line
require('./Princpal');
require('./Curso.js');
require('./Reactivos');

Vue.use(Editor);
Vue.use(BootstrapVue);
Vue.component('table-modificable', require('./components/tables/tablaModificable.vue').default);
if ($("#app").length != 0) var app = new Vue({
    el: '#app',
});