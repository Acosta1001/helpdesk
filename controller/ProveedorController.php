<?php
 include_once '../model/Proveedor.php';
 $proveedor = new Proveedor();

 //-------------------------------------------------------------------
 // Funcion para crear 
 //-------------------------------------------------------------------
 if ($_POST['funcion']=='crear'){
     $proveedor->Crear($_POST['nombre']);
 }

//-------------------------------------------------------------------
// Funcion para editar
//-------------------------------------------------------------------
if ($_POST['funcion']=='editar'){
    $proveedor->Editar($_POST['id'], $_POST['nombre']);
}

//-------------------------------------------------------------------
// Funcion eliminar
//-------------------------------------------------------------------
if ($_POST['funcion']=='eliminar'){
    $proveedor->Eliminar($_POST['id']);        
}

//-------------------------------------------------------------------
// Funcion para buscar todos los registros  
//-------------------------------------------------------------------
if ($_POST['funcion']=='buscar_todos'){
    //Variable que almacena la consulta en formato JSON
    $json=array();
    //LLamado al modelo
    $proveedor->BuscarTodos($_POST['dato']);
    foreach ($proveedor->objetos as $objeto) {
        $json[]=array(
                        'id'=>$objeto->id_prove,
                        'nombre'=>$objeto->nom_prove
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

//-------------------------------------------------------------------
// Funcion para buscar todos los registros DATATABLES
//-------------------------------------------------------------------
if ($_POST['funcion']=='listar'){
    //Variable que almacena la consulta en formato JSON
    $json=array();
    //LLamado al modelo
    $proveedor->BuscarTodos('');
    foreach ($proveedor->objetos as $objeto) {
        $json[]=array(
                        'id'=>$objeto->id_prove,
                        'nombre'=>$objeto->nom_prove
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

//-------------------------------------------------------------------
// Funcion para buscar un registros  
//-------------------------------------------------------------------
if ($_POST['funcion']=='buscar'){
    //Variable que almacena la consulta en formato JSON
    $json=array();
    //LLamado al modelo
    $proveedor->Buscar($_POST['dato']);
    foreach ($proveedor->objetos as $objeto) {
        
        $json[]=array(
                        'id'=>$objeto->id_prove,
                        'nombre'=>$objeto->nom_prove
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>