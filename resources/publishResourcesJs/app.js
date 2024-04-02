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

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
