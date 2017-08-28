var editor; // use a global for the submit and return data rendering in the examples
var tableactivas;
var tableinactivas;
var tableinvalidas;
var tablependientes;

$(document).ready(function() {

  tableactivas =   $('#usuariosactivos').DataTable( {
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        dom: "Bfrtip",
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ],
        ajax: "./usuariosactivos.php",
         columns: [
            {
                data: "db_users.id",
                defaultContent: "",
                className: 'select-checkbox'
            },
         
            { data: "db_users.name", className: 'editable'},
            { data: "db_users.username", className: 'editable'},
            { data: "db_users.correo", className: 'editable'},
            { data: "unidad.nombre", className: "hide_column", "targets": [ 0 ] },
            { data: "db_users.level", className: 'editable', render: function(data, type, row){  
                if (data == 0) {
                    return 'Fiscal General';
                }else{
                    if (data == 1) {
                        return 'Fiscal Regional';
                    }else{
                        if (data == 2) {
                            return 'Fiscal de Distrito';
                        }else{
                            if (data == 3) {
                                return 'Fiscal de Distrito Diverso';
                            }
                        }
                    }
                }
            }},
            { data: "db_users.create_at", className: 'editable'},
            { data: "db_users.update_at", className: 'editable'}

        ],
        order: [ 0, 'desc' ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        }
    } );
 
    
    tableinactivas =   $('#usuariosinactivos').DataTable( {
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        dom: "Bfrtip",
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ],
        ajax: "./usuariosinactivos.php",
         columns: [
            {
                data: "db_users.id",
                defaultContent: "",
                className: 'select-checkbox'
            },
         
            { data: "db_users.name", className: 'editable'},
            { data: "db_users.username", className: 'editable'},
            { data: "db_users.correo", className: 'editable'},
            { data: "unidad.nombre", className: "hide_column", "targets": [ 0 ] },
            { data: "db_users.level", className: 'editable', render: function(data, type, row){  
                if (data == 0) {
                    return 'Fiscal General';
                }else{
                    if (data == 1) {
                        return 'Fiscal Regional';
                    }else{
                        if (data == 2) {
                            return 'Fiscal de Distrito';
                        }else{
                            if (data == 3) {
                                return 'Fiscal de Distrito Diverso';
                            }
                        }
                    }
                }
            }},
            { data: "db_users.create_at", className: 'editable'},
            { data: "db_users.update_at", className: 'editable'}
            

        ],
        order: [ 0, 'desc' ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        }
    } );


    tableinvalidas =   $('#usuariosinvalidos').DataTable( {
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        dom: "Bfrtip",
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ],
        ajax: "./usuariosinvalidos.php",
         columns: [
            {
                data: "db_users.id",
                defaultContent: "",
                className: 'select-checkbox'
            },
         
            { data: "db_users.name", className: 'editable'},
            { data: "db_users.username", className: 'editable'},
            { data: "db_users.correo", className: 'editable'},
            { data: "unidad.nombre", className: "hide_column", "targets": [ 0 ] },
            { data: "db_users.create_at", className: 'editable'},
            { data: "db_users.update_at", className: 'editable'}
            

        ],
        order: [ 0, 'desc' ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        }
    } );


    tablependientes  =   $('#usuariospendientes').DataTable( {
        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        dom: "Bfrtip",
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ],
        ajax: "./usuariospendientes.php",
         columns: [
            {
                data: "db_users.id",
                defaultContent: "",
                className: 'select-checkbox'
            },
         
            { data: "db_users.name", className: 'editable'},
            { data: "db_users.username", className: 'editable'},
            { data: "db_users.correo", className: 'editable'},
            { data: "unidad.nombre", className: "hide_column", "targets": [ 0 ] },
            { data: "db_users.create_at", className: 'editable'}

        ],
        order: [ 0, 'desc' ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        }
    } );



} );
