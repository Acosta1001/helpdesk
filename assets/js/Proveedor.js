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
    tablaProveedor = $('#tablaProveedor').DataTable({  
        "responsive": true,
        "autoWidth": false,
        //Parametrizar lenguaje
        "language" : {
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
            "url": "../controller/ProveedorController.php",
            "method": 'POST', //usamos el metodo POST
            "data":{funcion:'listar'}, //enviamos POST
            "dataSrc":""
        },
        "lengthMenu":		[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
        "iDisplayLength":	5,
        "columns":[
            { "data": "id", "title":"ID"},
            { "data": "nombre", "title":"Nombre"},
            {"defaultContent": "<div class='btn-group'><button class='editar btn btn-sm btn-success' title='Editar' data-toggle='modal' data-target='#crear'><i class='fas fa-pencil-alt'></i><button class='eliminar btn btn-sm btn-danger' title='Eliminar'><i class='fas fa-trash'></i></button></div>", "title":"Acciones"}
        ],
        //Configurar COLUMNAS ---- Centrado Acciones
        "columnDefs": [ 
            {   "className": "text-center",
                "targets": [2],
                "visible": true,
                "searchable": true
            }
        ]
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
         if(tablaProveedor.row(this).child.isShown()){
              var data = tablaProveedor.row(this).data();
         }else{
              var data = tablaProveedor.row($(this).parents("tr")).data();
         }
         const id = data.id; //capturo el ID
        buscar(id);        
    }); 


    //-------------------------------------------------------------
    //Buscar un registro
    //-------------------------------------------------------------
    function buscar(dato) {
        funcion = 'buscar';
        $.post('../controller/ProveedorController.php',{dato, funcion},(response)=>{
            const respuesta = JSON.parse(response);
            $('#id_dep').val(respuesta.id);
            $('#nom_dep').val(respuesta.nombre);
        })
    };

    //----------------------------------------------------------
    // Funcion para crear o editar en el formulario
    //----------------------------------------------------------
    $('#form-crear').submit(e=>{
        let nombre = $('#nom_prove').val();
        let id = $('#id_prove').val();
        if (edit == true)
            funcion = 'editar';
        else
            funcion = 'crear';

        $.post('../controller/ProveedorController.php',{id, nombre, funcion},(response)=>{
            console.log(response);
            if(response == 'add' || response == 'update' ){ 
                //$('#addcliente').hide('slow');
                //$('#addcliente').show(1000);
                //$('#addcliente').hide(2000);
                $('#crear').modal('hide');
                tablaProveedor.ajax.reload(null, false);
            }   
            else{
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
            }  
        });
        e.preventDefault();
    });      

    //----------------------------------------------------------
    // Funcion que evalua click en ELIMNAR y obtiene el id
    // navegando a traves de la propiedad parentElement
    //----------------------------------------------------------
    $(document).on('click','.eliminar',function(){          
        if(tablaProveedor.row(this).child.isShown()){
            var data = tablaDependencia.row(this).data();
        }else{
            var data = tablaProveedor.row($(this).parents("tr")).data();
        }
        const id = data.id; //capturo el ID
        const nombre = data.nombre; //capturo el nombre		            
        //Cargo los objetos ocultos obtenidos con javascript y enviarlos al controlador
        buscar(id);        
        funcion = 'eliminar';

        Swal.fire({
            title: 'Desea eliminar '+nombre+'?',
            text: "Esto no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.value) {
                $.post('../controller/ProvedorController.php',{id, funcion},(response)=>{
                    if(response == 'eliminado' ){ 
                        Swal.fire(
                            'Eliminado!',
                            nombre + ' fue eliminado.',
                            'success'
                          )
                    }   
                    else{
                        Swal.fire(
                            'No se pudo eliminar!',
                            nombre + ' esta utilizado',
                            'error'
                          )
                    }  
                    tablaProvedor.ajax.reload(null, false);
                });
            }
          })
    });

});

 


    
