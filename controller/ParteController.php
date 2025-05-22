<?php
include_once '../model/Parte.php';
$parte = new Parte();

//-------------------------------------------------------------------
// Crear nueva parte
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'crear') {
    $parte->Crear(
        $_POST['placa_part'],
        $_POST['marca_part'],
        $_POST['serial_part'],
        $_POST['fecha_compra_part'],
        $_POST['proveedor_part'],
        $_POST['fecha_garantia_part'],
        $_POST['factura_part'],
        $_POST['observacion_parte'],
        $_POST['num_eq'],
        $_POST['id_est']
    );
}

//-------------------------------------------------------------------
// Editar parte
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'editar') {
    $parte->Editar(
        $_POST['id_part'],
        $_POST['placa_part'],
        $_POST['marca_part'],
        $_POST['serial_part'],
        $_POST['fecha_compra_part'],
        $_POST['proveedor_part'],
        $_POST['fecha_garantia_part'],
        $_POST['factura_part'],
        $_POST['observacion_parte'],
        $_POST['num_eq'],
        $_POST['id_est']
    );
}

//-------------------------------------------------------------------
// Eliminar parte
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'eliminar') {
    $parte->Eliminar($_POST['id_part']);
}

//-------------------------------------------------------------------
// Buscar todas las partes (filtrado por texto)
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'buscar_todos') {
    $json = array();
    $parte->BuscarTodos($_POST['dato']);
    foreach ($parte->objetos as $objeto) {
        $json[] = array(
            'id_part' => $objeto->id_part,
            'placa_part' => $objeto->placa_part,
            'marca_part' => $objeto->marca_part,
            'serial_part' => $objeto->serial_part,
            'num_eq' => $objeto->num_eq,
            'id_est' => $objeto->id_est
        );
    }
    echo json_encode($json);
}

//-------------------------------------------------------------------
// Listar todas las partes (DataTables)
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'listar') {
    $json = array();
    $parte->BuscarTodos('');
    foreach ($parte->objetos as $objeto) {
        $json[] = array(
            'id_part' => $objeto->id_part,
            'placa_part' => $objeto->placa_part,
            'marca_part' => $objeto->marca_part,
            'serial_part' => $objeto->serial_part,
            'num_eq' => $objeto->num_eq,
            'id_est' => $objeto->id_est
        );
    }
    echo json_encode($json);
}

//-------------------------------------------------------------------
// Buscar una parte por ID
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'buscar') {
    $json = array();
    $parte->Buscar($_POST['id_part']);
    foreach ($parte->objetos as $objeto) {
        $json[] = array(
            'id_part' => $objeto->id_part,
            'placa_part' => $objeto->placa_part,
            'marca_part' => $objeto->marca_part,
            'serial_part' => $objeto->serial_part,
            'fecha_compra_part' => $objeto->fecha_compra_part,
            'proveedor_part' => $objeto->proveedor_part,
            'fecha_garantia_part' => $objeto->fecha_garantia_part,
            'factura_part' => $objeto->factura_part,
            'observacion_parte' => $objeto->observacion_parte,
            'num_eq' => $objeto->num_eq,
            'id_est' => $objeto->id_est
        );
    }
    echo json_encode($json[0]);
}
?>
