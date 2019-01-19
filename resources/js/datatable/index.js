// import 'datatables';

// window.DataTable = DataTable;

// var dt = require( 'datatables' )( window, $ );

// export default dt;

// export default (function () {
// language: {
// 	'url' : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
// 	// More languages : http://www.datatables.net/plug-ins/i18n/
// }
// 	});
// }());

import * as $ from "jquery";

import "datatables";

$.extend($.fn.dataTable.defaults, {
    responsive: true,
    dom: "Bfrtip",
    serverSide: true,
    processing: true,
    fixedColumns: true,
    columnDefs: [
        { width: 200, targets: -1 }
    ],
    buttons: [
        {
            extend: "copy",
            text: '<i class="fa fa-clipboard"></i> Copiar',
            className: "btn btn-outline-primary",
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: "excel",
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: "btn btn-outline-primary",
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: "pdf",
            text: '<i class="fa fa-file-pdf-o"></i> PDF',
            className: "btn btn-outline-primary",
            exportOptions: {
                columns: ':visible'
            }
        },
        {
            extend: 'colvis',
            text: '<i class="fa fa-eye-slash"></i> Visibilidad',
            className: "btn btn-outline-primary",
        }
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
        
        buttons: {
            copyTitle: 'Copiado en el portapapeles',
            copySuccess: {
                _: '%d lineas copiadas',
                1: '1 línea copiada'
            }
        }
    }
});
