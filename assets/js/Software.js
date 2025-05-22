$(document).ready(function () {
    var funcion;
    var edit = false;

    //----------------------------------------------------------
    // Funcion que evalua click en EDITAR y obtiene el id
    // en DATATABLES responsives y llamado de funcion editar("#tablaDependencia tbody",tablaDependencia);
    //----------------------------------------------------------
    var editar = function(tbody, table){
        $(tbody).on("click","button.editar", function(){
        edit = true;
        $('#titulo').html('Editar');
         if(table.row(this).child.isShown()){
              var data = table.row(this).data();
         }else{
              var data = table.row($(this).parents("tr")).data();
         }
         const id = data.id; //capturo el ID	
         buscar(id);
        })
      };

    //----------------------------------------------------------
    // Construccion DataTable
    //----------------------------------------------------------
    tablaSoftware = $('#tablaSoftware').DataTable({
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
        "sProcessing": "Procesando...",
    },
    "ajax": {
        "url": "../controller/SoftwareController.php",
        "method": 'POST',
        "data": { funcion: 'listar' },
        "dataSrc": ""
    },
    "lengthMenu": [[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
    "iDisplayLength": 5,
    "columns": [
        { "data": "id_soft", "title": "ID" },
        { "data": "producto_soft", "title": "Producto" },
        { "data": "num_licencia_soft", "title": "Licencia" },
        { "data": "version_soft", "title": "Versión" },
        { "data": "cant_soft", "title": "Cantidad" },
        { "data": "fecha_compra_soft", "title": "Fecha de compra" },
        { "data": "valor_soft", "title": "Valor" },
        { "data": "proveedor_soft", "title": "Proveedor" },
        { "data": "factura_soft", "title": "Factura" },
        { "data": "disponible_soft", "title": "Disponible" },
        {
            "defaultContent": "<div class='btn-group'><button class='editar btn btn-sm btn-success' title='Editar' data-toggle='modal' data-target='#crear'><i class='fas fa-pencil-alt'></i></button><button class='eliminar btn btn-sm btn-danger' title='Eliminar'><i class='fas fa-trash'></i></button></div>",
            "title": "Acciones"
        }
    ],
    "columnDefs": [{
        "className": "text-center",
        "targets": [10],
        "visible": true,
        "searchable": true
    }]
});
  
    //editar("#tablaDependencia tbody",tablaDependencia);

    //----------------------------------------------------------
    // Funcion que evalua click en CREAR
    // Solo para limpiar el formulario
    //----------------------------------------------------------
    $(document).on('click','.btn-crear',(e)=>{
        $('#form-crear').trigger('reset');
        $('#titulo').html('Crear');
        edit = false;
    });

    //----------------------------------------------------------
    // Funcion que evalua click en EDITAR y obtiene el id
    // en DATATABLES responsives
    //----------------------------------------------------------
    $(document).on('click','.editar',function(){
        edit = true;
        $('#titulo').html('Editar');
         if(tablaSoftware.row(this).child.isShown()){
              var data = tablaSoftware.row(this).data();
         }else{
              var data = tablaSoftware.row($(this).parents("tr")).data();
         }
         const id = data.id; //capturo el ID
        buscar(id);        
    }); 


    //-------------------------------------------------------------
    //Buscar un registro
    //-------------------------------------------------------------
    function buscar(id) {
        funcion = 'buscar';
        $.post('../controller/SoftwareController.php', { id, funcion }, (response) => {
            const s = JSON.parse(response);
            $('#id_soft').val(s.id_soft);
            $('#producto_soft').val(s.producto_soft);
            $('#num_licencia_soft').val(s.num_licencia_soft);
            $('#version_soft').val(s.version_soft);
            $('#cant_soft').val(s.cant_soft);
            $('#fecha_compra_soft').val(s.fecha_compra_soft);
            $('#valor_soft').val(s.valor_soft);
            $('#proveedor_soft').val(s.proveedor_soft);
            $('#factura_soft').val(s.factura_soft);
            $('#disponible_soft').val(s.disponible_soft);
    });
}


    //----------------------------------------------------------
    // Funcion para crear o editar en el formulario
    //----------------------------------------------------------
    $('#form-crear').submit(e => {
    e.preventDefault();
    funcion = edit ? 'editar' : 'crear';

    let datos = {
        id_soft: $('#id_soft').val(),
        producto_soft: $('#producto_soft').val(),
        num_licencia_soft: $('#num_licencia_soft').val(),
        version_soft: $('#version_soft').val(),
        cant_soft: $('#cant_soft').val(),
        fecha_compra_soft: $('#fecha_compra_soft').val(),
        valor_soft: $('#valor_soft').val(),
        proveedor_soft: $('#proveedor_soft').val(),
        factura_soft: $('#factura_soft').val(),
        disponible_soft: $('#disponible_soft').val(),
        funcion: funcion
    };

    $.post('../controller/SoftwareController.php', datos, (response) => {
        console.log(response);
        if (response === 'add' || response === 'update') {
            $('#crear').modal('hide');
            tablaSoftware.ajax.reload(null, false);
        } else {
            $('#noadd').hide('slow').show(1000).hide(2000);
        }
    });
});
    

    //----------------------------------------------------------
    // Funcion que evalua click en ELIMNAR y obtiene el id
    // navegando a traves de la propiedad parentElement
    //----------------------------------------------------------
    $(document).on('click', '.eliminar', function () {
    var data = tablaSoftware.row($(this).parents("tr")).data();
    const id = data.id_soft;
    const nombre = data.producto_soft;
    funcion = 'eliminar';

    Swal.fire({
        title: '¿Desea eliminar ' + nombre + '?',
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
            $.post('../controller/SoftwareController.php', { id, funcion }, (response) => {
                if (response == 'eliminado') {
                    Swal.fire('Eliminado!', nombre + ' fue eliminado.', 'success');
                } else {
                    Swal.fire('No se pudo eliminar!', nombre + ' está en uso.', 'error');
                }
                tablaSoftware.ajax.reload(null, false);
            });
        }
    });
});

})
