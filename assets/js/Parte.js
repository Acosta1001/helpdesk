$(document).ready(function () {
    var funcion;
    var edit = false;

    // Construcción DataTable para PARTES
    tablaParte = $('#tablaParte').DataTable({
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
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando..."
        },
        "ajax": {
            "url": "../controller/ParteController.php",
            "method": 'POST',
            "data": { funcion: 'listar' },
            "dataSrc": ""
        },
        "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "iDisplayLength": 5,
        "columns": [
            { "data": "id_part", "title": "ID" },
            { "data": "placa_part", "title": "Placa" },
            { "data": "marca_part", "title": "Marca" },
            { "data": "serial_part", "title": "Serial" },
            { "data": "num_eq", "title": "Equipo" },
            { "data": "id_est", "title": "Estado" },
            {
                "defaultContent": "<div class='btn-group'><button class='editar btn btn-sm btn-success' title='Editar' data-toggle='modal' data-target='#crear'><i class='fas fa-pencil-alt'></i></button><button class='eliminar btn btn-sm btn-danger' title='Eliminar'><i class='fas fa-trash'></i></button></div>",
                "title": "Acciones"
            }
        ],
        "columnDefs": [
            {
                "className": "text-center",
                "targets": [6]
            }
        ]
    });

    // Limpia el formulario cuando se presiona CREAR
    $(document).on('click', '.btn-crear', (e) => {
        $('#form-crear').trigger('reset');
        $('#titulo').html('Crear Parte');
        edit = false;
    });

    // Buscar parte por ID (para EDITAR)
    $(document).on('click', '.editar', function () {
        edit = true;
        $('#titulo').html('Editar Parte');
        var data = tablaParte.row($(this).parents("tr")).data();
        buscar(data.id_part);
    });

    function buscar(id_part) {
        funcion = 'buscar';
        $.post('../controller/ParteController.php', { id_part, funcion }, (response) => {
            const res = JSON.parse(response);
            $('#id_part').val(res.id_part);
            $('#placa_part').val(res.placa_part);
            $('#marca_part').val(res.marca_part);
            $('#serial_part').val(res.serial_part);
            $('#fecha_compra_part').val(res.fecha_compra_part);
            $('#proveedor_part').val(res.proveedor_part);
            $('#fecha_garantia_part').val(res.fecha_garantia_part);
            $('#factura_part').val(res.factura_part);
            $('#observacion_parte').val(res.observacion_parte);
            $('#num_eq').val(res.num_eq);
            $('#id_est').val(res.id_est);
        });
    }

    // Crear o editar parte
    $('#form-crear').submit(e => {
        e.preventDefault();
        let id_part = $('#id_part').val();
        let placa_part = $('#placa_part').val();
        let marca_part = $('#marca_part').val();
        let serial_part = $('#serial_part').val();
        let fecha_compra_part = $('#fecha_compra_part').val();
        let proveedor_part = $('#proveedor_part').val();
        let fecha_garantia_part = $('#fecha_garantia_part').val();
        let factura_part = $('#factura_part').val();
        let observacion_parte = $('#observacion_parte').val();
        let num_eq = $('#num_eq').val();
        let id_est = $('#id_est').val();

        funcion = edit ? 'editar' : 'crear';

        $.post('../controller/ParteController.php', {
            id_part, placa_part, marca_part, serial_part,
            fecha_compra_part, proveedor_part, fecha_garantia_part,
            factura_part, observacion_parte, num_eq, id_est, funcion
        }, (response) => {
            $('#form-crear').trigger('reset');
            $('#crear').modal('hide');
            tablaParte.ajax.reload(null, false);
        });
    });

    // Eliminar parte
    $(document).on('click', '.eliminar', function () {
        var data = tablaParte.row($(this).parents("tr")).data();
        const id_part = data.id_part;
        const placa = data.placa_part;
        funcion = 'eliminar';

        Swal.fire({
            title: '¿Deseas eliminar "' + placa + '"?',
            text: "Esto no se podrá revertir.",
            icon: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sí, eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controller/ParteController.php', { id_part, funcion }, (response) => {
                    if (response.trim() == 'eliminado') {
                        Swal.fire('Eliminado!', 'La parte fue eliminada.', 'success');
                    } else {
                        Swal.fire('Error!', 'No se pudo eliminar.', 'error');
                    }
                    tablaParte.ajax.reload(null, false);
                });
            }
        });
    });

});
