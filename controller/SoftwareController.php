<?php
include_once '../model/Software.php';
$software = new Software();

//-------------------------------------------------------------------
// Crear software
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'crear') {
    $software->Crear(
        $_POST['id_soft'] ?? null,
        $_POST['producto_soft'] ?? null,
        $_POST['num_licencia_soft' ?? null],
        $_POST['version_soft'] ?? null,
        $_POST['cant_soft'] ?? null,
        $_POST['fecha_compra_soft'] ?? null,
        $_POST['valor_soft'] ?? null,
        $_POST['proveedor_soft'] ?? null,
        $_POST['factura_soft'] ?? null,
        $_POST['disponible_soft'] ?? null
    );
}

//-------------------------------------------------------------------
// Editar software
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'editar') {
    $software->Editar(
        $_POST['id_soft'] ?? null,
        $_POST['producto_soft'] ?? null,
        $_POST['num_licencia_soft'] ?? null,
        $_POST['version_soft'] ?? null,
        $_POST['cant_soft'] ?? null,
        $_POST['fecha_compra_soft'] ?? null,
        $_POST['valor_soft'] ?? null,
        $_POST['proveedor_soft'] ?? null,
        $_POST['factura_soft'] ?? null,
        $_POST['disponible_soft'] ?? null
    );
}

//-------------------------------------------------------------------
// Eliminar software
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'eliminar') {
    $software->Eliminar($_POST['id_soft']);
}

//-------------------------------------------------------------------
// Buscar todos los registros con filtro
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'buscar_todos') {
    $json = array();
    $software->BuscarTodos($_POST['dato']);
    foreach ($software->objetos as $objeto) {
        $json[] = array(
            'id_soft' => $objeto->id_soft,
            'producto_soft' => $objeto->producto_soft,
            'num_licencia_soft' => $objeto->num_licencia_soft,
            'version_soft' => $objeto->version_soft,
            'cant_soft' => $objeto->cant_soft,
            'fecha_compra_soft' => $objeto->fecha_compra_soft,
            'valor_soft' => $objeto->valor_soft,
            'proveedor_soft' => $objeto->proveedor_soft,
            'factura_soft' => $objeto->factura_soft,
            'disponible_soft' => $objeto->disponible_soft
        );
    }
    echo json_encode($json);
}

//-------------------------------------------------------------------
// Buscar todos los registros (para listarlos en DataTable)
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'listar') {
    $json = array();
    $software->BuscarTodos('');
    foreach ($software->objetos as $objeto) {
        $json[] = array(
            'id_soft' => $objeto->id_soft,
            'producto_soft' => $objeto->producto_soft,
            'num_licencia_soft' => $objeto->num_licencia_soft,
            'version_soft' => $objeto->version_soft,
            'cant_soft' => $objeto->cant_soft,
            'fecha_compra_soft' => $objeto->fecha_compra_soft,
            'valor_soft' => $objeto->valor_soft,
            'proveedor_soft' => $objeto->proveedor_soft,
            'factura_soft' => $objeto->factura_soft,
            'disponible_soft' => $objeto->disponible_soft
        );
    }
    echo json_encode($json);
}

//-------------------------------------------------------------------
// Buscar un software por ID
//-------------------------------------------------------------------
if ($_POST['funcion'] == 'buscar') {
    $json = array();
    $software->Buscar($_POST['id_soft']);
    foreach ($software->objetos as $objeto) {
        $json[] = array(
            'id_soft' => $objeto->id_soft,
            'producto_soft' => $objeto->producto_soft,
            'num_licencia_soft' => $objeto->num_licencia_soft,
            'version_soft' => $objeto->version_soft,
            'cant_soft' => $objeto->cant_soft,
            'fecha_compra_soft' => $objeto->fecha_compra_soft,
            'valor_soft' => $objeto->valor_soft,
            'proveedor_soft' => $objeto->proveedor_soft,
            'factura_soft' => $objeto->factura_soft,
            'disponible_soft' => $objeto->disponible_soft
        );
    }
    echo json_encode($json[0]);
}
?>
