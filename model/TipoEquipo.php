<?php
include_once 'Conexion.php';

class TipoEquipo {
    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    // Crear
    public function Crear($nombre){
        $sql = "INSERT INTO tipo_equipo (nom_tip) VALUE (:nombre)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre));
        echo 'add';
    }

    // Editar
    public function Editar($id, $nombre){
        $sql = "UPDATE tipo_equipo SET nom_tip = :nombre WHERE id_tip = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id, ':nombre'=>$nombre));
        echo 'update';
    }

    // Eliminar
    public function Eliminar($id){
        $sql = "DELETE FROM tipo_equipo WHERE id_tip = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));

        if($query->rowCount() > 0)
            echo 'eliminado';
        else
            echo 'noeliminado';
    }

    // Buscar todos según criterio de búsqueda
    public function BuscarTodos($consulta){
        if(!empty($consulta)){
            $sql = "SELECT * FROM tipo_equipo WHERE nom_tip LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
        } else {
            $sql = "SELECT * FROM tipo_equipo ORDER BY id_tip";
            $query = $this->acceso->prepare($sql);
            $query->execute();
        }
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    // Buscar uno por ID
    public function Buscar($id){
        $sql = "SELECT * FROM tipo_equipo WHERE id_tip = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
?>
