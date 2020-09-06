import 'jquery-ui/ui/widgets/datepicker.js';
//import $ from 'jquery';
import BootstrapVue from 'bootstrap-vue'
import Editor from '@tinymce/tinymce-vue';
import 'mathjax/es5/tex-chtml-full';
import AOS from 'aos';
require('d3');
require('c3');

import * as d3 from 'd3';
import * as c3 from 'c3';

 import VueC3 from 'vue-c3';


window.d3=global.d3=d3;
window.c3 =global.c3 =c3;

require('./bootstrap');
window.Vue = require('vue');
Vue.use(Editor);
Vue.use(VueC3);
//require('tinymce');

window.$ = window.jQuery = $;
global.$ = global.jQuery = require('jquery');
global.Editor = Editor;

global.AOS =window.AOS = window.AOS = AOS;

window.Editor=Editor;
window.Vue = require('vue');

require('./bootstrap');
Vue.use(BootstrapVue);

import VueAos from 'vue-aos';
Vue.use(VueAos);
require( 'isotope-layout');
require( 'venobox/venobox/venobox.min.js').default;//jshint ignore:line
require(  'owl.carousel/dist/assets/owl.carousel.css').default;//jshint ignore:line
require(  'owl.carousel').default;//jshint ignore:line
require('aos').default;//jshint ignore:line
import isotope from  'isotope-layout';

Vue.component('tablamodelo', require('./components/TablaModelo.vue').default);
$(document).ready(function() {
require('./Princpal');
require('./Curso.js');
require('./Reactivos');
});
