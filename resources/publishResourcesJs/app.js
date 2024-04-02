import './bootstrap';
import './toast';
import './datatables';

import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import Swal from 'sweetalert2';
window.Swal = Swal;

import Cookies from 'js-cookie';
window.Cookies = Cookies;

import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-fixedcolumns-bs5';
import 'datatables.net-fixedheader-bs5';
import 'datatables.net-responsive-bs5';
import 'datatables.net-searchbuilder-bs5';
import 'datatables.net-searchpanes-bs5';
import 'datatables.net-staterestore-bs5';
window.DataTable = DataTable;
window.JSZip = jszip;
window.pdfMake = pdfmake;

// jqueryui
import 'jqueryui';

// Leaflet
import leaflet from 'leaflet';
window.L = leaflet;

// Dropzone
import Dropzone from 'dropzone';
window.Dropzone = Dropzone;

// Select2
import * as select2 from 'select2';
window.Select2 = select2;
import 'select2/dist/js/i18n/fr'; // il faut aussi préciser la langue dans déclaration du select

// CKEditor 
import ckeditor5 from '@ckeditor/ckeditor5-build-classic';
window.CKEditor = ckeditor5;
import '@ckeditor/ckeditor5-build-classic/build/translations/fr'; // il faut aussi préciser la langue dans déclaration du ckeditor

// Bootstrap-datepicker
import * as datepicker from 'bootstrap-datepicker';
window.datepicker = datepicker;

// Bootstrap-select                                 // INCOMPATIBLE AVEC VITE
// import 'bootstrap-select/js/bootstrap-select';
// $.fn.selectpicker.Constructor.BootstrapVersion = '5';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
