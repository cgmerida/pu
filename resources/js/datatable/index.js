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
    // dom: "fBlrtip",
    dom: '<"btns_wrapper"B><"top"fl>rt<"bottom"ip>',
    serverSide: true,
    processing: true,
    fixedColumns: true,
    columnDefs: [{
        width: 200,
        targets: -1
    }],
    buttons: {
        dom: {
            button: {
                tag: 'button',
                className: ''
            }
        },
        buttons: [{
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
        ]
    },
    language: {
        sProcessing: "<i class='fa fa-circle-o-notch fa-spin fa-5x fa-fw'></i>",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        },

        buttons: {
            copyTitle: 'Copiado en el portapapeles',
            copySuccess: {
                _: '%d lineas copiadas',
                1: '1 línea copiada'
            }
        }
    }
});
