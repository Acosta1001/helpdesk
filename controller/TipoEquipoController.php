<?php
include_once '../model/TipoEquipo.php';
$tipoEquipo = new TipoEquipo();

//-------------------------------------------------------------------
// Funcion para crear 
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'crear') {
    $tipoEquipo->Crear($_POST['nombre']);
}

//-------------------------------------------------------------------
// Funcion para editar
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'editar') {
    $tipoEquipo->Editar($_POST['id'], $_POST['nombre']);
}

//-------------------------------------------------------------------
// Funcion eliminar
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'eliminar') {
    $tipoEquipo->Eliminar($_POST['id']);
}

//-------------------------------------------------------------------
// Funcion para buscar todos los registros  
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'buscar_todos') {
    $json = array();
    $tipoEquipo->BuscarTodos($_POST['dato']);
    foreach ($tipoEquipo->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_tip,
            'nombre' => $objeto->nom_tip
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

//-------------------------------------------------------------------
// Funcion para buscar todos los registros para DataTables
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'listar') {
    $json = array();
    $tipoEquipo->BuscarTodos('');
    foreach ($tipoEquipo->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_tip,
            'nombre' => $objeto->nom_tip
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

//-------------------------------------------------------------------
// Funcion para buscar un registro específico  
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'buscar') {
    $json = array();
    $tipoEquipo->Buscar($_POST['dato']);
    foreach ($tipoEquipo->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_tip,
            'nombre' => $objeto->nom_tip
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>
