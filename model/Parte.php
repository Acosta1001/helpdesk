<?php
include_once 'Conexion.php';

class Parte {
    var $objetos;
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->pdo; // usamos tu atributo $pdo directamente
    }

    public function Crear($placa, $marca, $serial, $fecha_compra, $proveedor, $fecha_garantia, $factura, $observacion, $num_eq, $id_est) {
        $sql = "INSERT INTO parte (placa_part, marca_part, serial_part, fecha_compra_part, proveedor_part, fecha_garantia_part, factura_part, observacion_parte, num_eq, id_est)
                VALUES (:placa, :marca, :serial, :fecha_compra, :proveedor, :fecha_garantia, :factura, :observacion, :num_eq, :id_est)";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':placa' => $placa,
            ':marca' => $marca,
            ':serial' => $serial,
            ':fecha_compra' => $fecha_compra,
            ':proveedor' => $proveedor,
            ':fecha_garantia' => $fecha_garantia,
            ':factura' => $factura,
            ':observacion' => $observacion,
            ':num_eq' => $num_eq,
            ':id_est' => $id_est
        ]);
    }

    public function Editar($id, $placa, $marca, $serial, $fecha_compra, $proveedor, $fecha_garantia, $factura, $observacion, $num_eq, $id_est) {
        $sql = "UPDATE parte SET placa_part=:placa, marca_part=:marca, serial_part=:serial,
                fecha_compra_part=:fecha_compra, proveedor_part=:proveedor, fecha_garantia_part=:fecha_garantia,
                factura_part=:factura, observacion_parte=:observacion, num_eq=:num_eq, id_est=:id_est
                WHERE id_part=:id";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            ':id' => $id,
            ':placa' => $placa,
            ':marca' => $marca,
            ':serial' => $serial,
            ':fecha_compra' => $fecha_compra,
            ':proveedor' => $proveedor,
            ':fecha_garantia' => $fecha_garantia,
            ':factura' => $factura,
            ':observacion' => $observacion,
            ':num_eq' => $num_eq,
            ':id_est' => $id_est
        ]);
    }

    public function Eliminar($id) {
        $sql = "DELETE FROM parte WHERE id_part=:id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
    }

    public function Buscar($id) {
        $sql = "SELECT * FROM parte WHERE id_part=:id";
        $query = $this->pdo->prepare($sql);
        $query->execute([':id' => $id]);
        $this->objetos = $query->fetchAll();
    }

    public function BuscarTodos($filtro) {
        $sql = "SELECT * FROM parte WHERE placa_part LIKE :filtro";
        $query = $this->pdo->prepare($sql);
        $query->execute([':filtro' => "%$filtro%"]);
        $this->objetos = $query->fetchAll();
    }
}
?>
