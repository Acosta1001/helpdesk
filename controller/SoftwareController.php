<?php
 include_once '../model/Software.php';
 $software = new Software();

 //-------------------------------------------------------------------
 // Funcion para crear 
 //-------------------------------------------------------------------
 if ($_POST['funcion']=='crear'){
     $software->Crear(
                            $_POST['producto_soft'],
                            $_POST['num_licencia_soft'],
                            $_POST['version_soft'],
                            $_POST['cant_soft']
                        );
 }

//-------------------------------------------------------------------
// Funcion para editar
//-------------------------------------------------------------------
if ($_POST['funcion']=='editar'){
    $software->Editar($_POST['id_soft'], $_POST['producto_soft']);
}

//-------------------------------------------------------------------
// Funcion eliminar
//-------------------------------------------------------------------
if ($_POST['funcion']=='eliminar'){
    $software->Eliminar($_POST['id_soft']);        
}

//-------------------------------------------------------------------
// Funcion para buscar todos los registros  
//-------------------------------------------------------------------
if ($_POST['funcion']=='buscar_todos'){
    //Variable que almacena la consulta en formato JSON
    $json=array();
    //LLamado al modelo
    $software->BuscarTodos($_POST['dato']);
    foreach ($software->objetos as $objeto) {
        $json[]=array(
                        'id'=>$objeto->id_soft,
                        'producto'=>$objeto->producto_soft,
                        'version'=>$objeto->version_soft,
                        'cantidad'=>$objeto->cant_soft
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
    $software->BuscarTodos('');
    foreach ($software->objetos as $objeto) {
        $json[]=array(
                        'id'=>$objeto->id_soft,
                        'producto'=>$objeto->producto_soft,
                        'version'=>$objeto->version_soft,
                        'cantidad'=>$objeto->cant_soft
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
    $software->Buscar($_POST['dato']);
    foreach ($software->objetos as $objeto) {
        
        $json[]=array(
                        'id'=>$objeto->id_soft,
                        'producto'=>$objeto->producto_soft,
                        'version'=>$objeto->version_soft,
                        'cantidad'=>$objeto->cant_soft
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>