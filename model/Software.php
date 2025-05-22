<?php
include_once 'Conexion.php';

class Software {
    var $objetos;
    var $acceso;

    public function __construct() {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //------------------------------------
    // Crear nuevo software con todos los campos
    //------------------------------------
    public function Crear($id, $producto, $licencia, $version, $cantidad, $fecha_compra, $valor, $proveedor, $factura, $disponible) {
        $sql = "INSERT INTO software 
                (id_soft, producto_soft, num_licencia_soft, version_soft, cant_soft, fecha_compra_soft, valor_soft, proveedor_soft, factura_soft, disponible_soft)
                VALUES 
                (:id, :producto, :licencia, :version, :cantidad, :fecha_compra, :valor, :proveedor, :factura, :disponible)";
        $query = $this->acceso->prepare($sql);
        $query->execute([
            ':id' => $id,
            ':producto' => $producto,
            ':licencia' => $licencia,
            ':version' => $version,
            ':cantidad' => $cantidad,
            ':fecha_compra' => $fecha_compra,
            ':valor' => $valor,
            ':proveedor' => $proveedor,
            ':factura' => $factura,
            ':disponible' => $disponible
        ]);
        echo 'add';
    }

    //------------------------------------
    // Editar software por ID
    //------------------------------------
    public function Editar($id, $producto, $licencia, $version, $cantidad, $fecha_compra, $valor, $proveedor, $factura, $disponible) {
        $sql = "UPDATE software SET 
                    producto_soft = :producto,
                    num_licencia_soft = :licencia,
                    version_soft = :version,
                    cant_soft = :cantidad,
                    fecha_compra_soft = :fecha_compra,
                    valor_soft = :valor,
                    proveedor_soft = :proveedor,
                    factura_soft = :factura,
                    disponible_soft = :disponible
                WHERE id_soft = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute([
            ':id' => $id,
            ':producto' => $producto,
            ':licencia' => $licencia,
            ':version' => $version,
            ':cantidad' => $cantidad,
            ':fecha_compra' => $fecha_compra,
            ':valor' => $valor,
            ':proveedor' => $proveedor,
            ':factura' => $factura,
            ':disponible' => $disponible
        ]);
        echo 'update';
    }

    //------------------------------------
    // Eliminar software
    //------------------------------------
    public function Eliminar($id) {
        $sql = "DELETE FROM software WHERE id_soft = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id' => $id]);
        if ($query->rowCount() > 0)
            echo 'eliminado';
        else
            echo 'noeliminado';
    }

    //------------------------------------
    // Buscar todos los softwares (con filtro)
    //------------------------------------
    public function BuscarTodos($consulta) {
        if (!empty($consulta)) {
            $sql = "SELECT * FROM software WHERE producto_soft LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute([':consulta' => "%$consulta%"]);
        } else {
            $sql = "SELECT * FROM software ORDER BY id_soft";
            $query = $this->acceso->prepare($sql);
            $query->execute();
        }
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    //------------------------------------
    // Buscar software por ID
    //------------------------------------
    public function Buscar($id) {
        $sql = "SELECT * FROM software WHERE id_soft = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id' => $id]);
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
?>
