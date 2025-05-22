$(document).ready(function () {
    var funcion;
    var edit = false;

    var editar = function(tbody, table){
        $(tbody).on("click","button.editar", function(){
            edit = true;
            $('#titulo').html('Editar');
            var data = table.row($(this).parents("tr")).data();
            const id = data.id;
            buscar(id);
        })
    };

    tablaTipoEquipo = $('#tablaTipoEquipo').DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing":"Procesando...",
        },
        "ajax":{
            "url": "../controller/TipoEquipoController.php",
            "method": 'POST',
            "data": { funcion: 'listar' },
            "dataSrc": ""
        },
        "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "iDisplayLength": 5,
        "columns": [
            { "data": "id", "title": "ID" },
            { "data": "nombre", "title": "Nombre" },
            {
                "defaultContent": "<div class='btn-group'>" +
                                  "<button class='editar btn btn-sm btn-success' title='Editar' data-toggle='modal' data-target='#crear'>" +
                                  "<i class='fas fa-pencil-alt'></i></button>" +
                                  "<button class='eliminar btn btn-sm btn-danger' title='Eliminar'>" +
                                  "<i class='fas fa-trash'></i></button></div>",
                "title": "Acciones"
            }
        ],
        "columnDefs": [
            { "className": "text-center", "targets": [2] }
        ]
    });

    $(document).on('click', '.btn-crear', (e) => {
        $('#form-crear').trigger('reset');
        $('#titulo').html('Crear');
        edit = false;
    });

    $(document).on('click', '.editar', function(){
        edit = true;
        $('#titulo').html('Editar');
        var data = tablaTipoEquipo.row($(this).parents("tr")).data();
        const id = data.id;
        buscar(id);
    });

    function buscar(dato) {
        funcion = 'buscar';
        $.post('../controller/TipoEquipoController.php', { dato, funcion }, (response) => {
            const respuesta = JSON.parse(response);
            $('#id_tip').val(respuesta.id);
            $('#nom_tip').val(respuesta.nombre);
        });
    }

    $('#form-crear').submit(e => {
        let nombre = $('#nom_tip').val();
        let id = $('#id_tip').val();
        funcion = edit ? 'editar' : 'crear';

        $.post('../controller/TipoEquipoController.php', { id, nombre, funcion }, (response) => {
            console.log(response);
            if (response == 'add' || response == 'update') {
                $('#crear').modal('hide');
                tablaTipoEquipo.ajax.reload(null, false);
            } else {
                $('#noadd').hide('slow').show(1000).hide(2000);
            }
        });
        e.preventDefault();
    });

    $(document).on('click', '.eliminar', function(){
        var data = tablaTipoEquipo.row($(this).parents("tr")).data();
        const id = data.id;
        const nombre = data.nombre;
        buscar(id);
        funcion = 'eliminar';

        Swal.fire({
            title: 'Desea eliminar ' + nombre + '?',
            text: "Esto no se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.value) {
                $.post('../controller/TipoEquipoController.php', { id, funcion }, (response) => {
                    if (response == 'eliminado') {
                        Swal.fire('Eliminado!', nombre + ' fue eliminado.', 'success');
                    } else {
                        Swal.fire('No se pudo eliminar!', nombre + ' está siendo utilizado.', 'error');
                    }
                    tablaTipoEquipo.ajax.reload(null, false);
                });
            }
        })
    });

});
