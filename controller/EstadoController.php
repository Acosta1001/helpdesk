<?php
 include_once '../model/Estado.php';
 $estado = new Estado();

 //-------------------------------------------------------------------
 // Funcion para crear 
 //-------------------------------------------------------------------
 if ($_POST['funcion']=='crear'){
     $estado->Crear($_POST['id'], $_POST['nombre']);
 }

//-------------------------------------------------------------------
// Funcion para editar
//-------------------------------------------------------------------
if ($_POST['funcion']=='editar'){
    $estado->Editar($_POST['id'], $_POST['nombre']);
}

//-------------------------------------------------------------------
// Funcion eliminar
//-------------------------------------------------------------------
if ($_POST['funcion']=='eliminar'){
    $estado->Eliminar($_POST['id']);        
}

//-------------------------------------------------------------------
// Funcion para buscar todos los registros  
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'buscar_todos') {
    $json = array();
    $estado->BuscarTodos($_POST['dato']);
    foreach ($estado->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_est,
            'nombre' => $objeto->nom_est
        );
    }

    $jsonstring = json_encode(['data' => $json], JSON_UNESCAPED_UNICODE);
    header('Content-Type: application/json');
    echo $jsonstring;
}


//-------------------------------------------------------------------
// Funcion para buscar todos los registros DATATABLES
//-------------------------------------------------------------------
if ($_POST['funcion']=='listar'){
    //Variable que almacena la consulta en formato JSON
    $json=array();
    //LLamado al modelo
    $estado->BuscarTodos('');
    foreach ($estado->objetos as $objeto) {
        $json[]=array(
                        'id'=>$objeto->id_est,
                        'nombre'=>$objeto->nom_est
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
    $estado->Buscar($_POST['dato']);
    foreach ($estado->objetos as $objeto) {
        
        $json[]=array(
                        'id'=>$objeto->id_est,
                        'nombre'=>$objeto->nom_est
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>