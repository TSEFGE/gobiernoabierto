var editor; // use a global for the submit and return data rendering in the examples
var table;
$(document).ready(function() {
/*    editor = new $.fn.dataTable.Editor( {
        ajax: "./detenidos.php",
        table: "#detenidos",
        fields: [ 
            {
                label: "Nombre:",
                name: "nombre"
            },{
                label: "Paterno:",
                name: "paterno"
            },{
                label: "Materno:",
                name: "materno"
            },{
                label: "Sexo:",
                name: "sexo",
                type: "select",
                ipOpts: [{ "label": "MASCULINO", "value": "MASCULINO" },
                           { "label": "FEMENINO", "value": "FEMENINO"}]
            }, {
                label: "fechaNacimiento:",
                name: "fechaNacimiento"
            }, {
                label: "Fecha Inicio:",
                name: "fechaInicio",
               type: "datetime",
                def:       function () { return new Date(); },
                format:    'YYYY/MM/DD HH:MM:SS'
            }, {
                label: "Fecha Fin:",
                name: "fechaFin",
                type: "datetime",
                def:       function () { return new Date(); },
                format:    'YYYY/MM/DD HH:MM:SS'
            }, {
                label: "Unidad:",
                name: "unidad",
                type: "hidden"
            }
            , {
                label: "Ubicacion:",
                name: "ubicacion",
            }
        ]
    } );
*/
  table =   $('#detenidos').DataTable( {
         /*   language: {
             //   "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },*/
        dom: "Bfrtip",
        ajax: "./detenidos.php",
         columns: [
            {
                data: "detencion.id",
                defaultContent: "",
                className: 'select-checkbox',
                orderable: false
            },
         /*   { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                return data.detenido.nombre+' '+data.detenido.paterno+' '+data.detenido.materno;
            }},*/
            { data: "detenido.nombre", className: 'editable'},
            { data: "detenido.paterno", className: 'editable'},
            { data: "detenido.materno", className: 'editable'},
            { data: "detenido.sexo", className: 'editable'},
            { data: "detenido.fechaNacimiento", className: 'editable'},
            { data: "detencion.fechaInicio", className: 'editable'},
            { data: "detencion.fechaFin", className: 'editable'},
            { data: "unidad.nombre", className: 'readonly'},
            { data: "detencion.ubicacion", className: 'editable'},
            { data: "unidad.id", className: "hide_column", "targets": [ 0 ] }


        ],
        order: [ 6, 'desc' ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
      /* { extend: "edit"},
             { extend: "remove" }        */
        ]
    } );
/*
$('#detenidos tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );*/

    /*$('#detenidos tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );*/
 
    $('#removeBtn').click( function () {
//        removeDetenido();
    } );

    $('#editBtn').click( function () {
      //  editDetenido();
    } );

    $('#cancelBtn').click( function () {
    //    editDetenido();
    } );
} );
