<?php
include_once 'Conexion.php';

class Usuarios {
    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //----------------------------//
    // Crear usuario             //
    //----------------------------//
    public function Crear($nombre, $telefono, $email, $pass, $dni, $avatar, $tipo){
        $sql = "INSERT INTO usuario (nom_usu, tel_usu, email_usu, pass_usu, dni_usu, avatar_usu, id_tipo_usu) 
                VALUES (:nombre, :telefono, :email, :pass, :dni, :avatar, :tipo)";
        $query = $this->acceso->prepare($sql);
        $query->execute([
            ':nombre' => $nombre,
            ':telefono' => $telefono,
            ':email' => $email,
            ':pass' => $pass,
            ':dni' => $dni,
            ':avatar' => $avatar,
            ':tipo' => $tipo
        ]);
        echo 'add';
    }

    //----------------------------//
    // Editar usuario            //
    //----------------------------//
    public function Editar($id, $nombre, $telefono, $email, $dni, $tipo){
        $sql = "UPDATE usuario SET nom_usu = :nombre, tel_usu = :telefono, email_usu = :email, 
                dni_usu = :dni, id_tipo_usu = :tipo WHERE id_usu = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':telefono' => $telefono,
            ':email' => $email,
            ':dni' => $dni,
            ':tipo' => $tipo
        ]);
        echo 'update';
    }

    //----------------------------//
    // Eliminar usuario          //
    //----------------------------//
    public function Eliminar($id){
        $sql = "DELETE FROM usuario WHERE id_usu = :id";
        $query = $this->acceso->prepare($sql);
        $success = $query->execute([':id' => $id]);
        echo $success ? 'eliminado' : 'noeliminado';
    }

    //----------------------------//
    // Buscar usuarios           //
    //----------------------------//
    public function BuscarTodos($consulta){
        if (!empty($consulta)) {
            $sql = "SELECT * FROM usuario WHERE nom_usu LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute([':consulta' => "%$consulta%"]);
        } else {
            $sql = "SELECT * FROM usuario ORDER BY id_usu";
            $query = $this->acceso->prepare($sql);
            $query->execute();
        }
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }

    //----------------------------//
    // Buscar por ID             //
    //----------------------------//
    public function Buscar($id){
        $sql = "SELECT * FROM usuario WHERE id_usu = :id";
        $query = $this->acceso->prepare($sql);
        $query->execute([':id' => $id]);
        $this->objetos = $query->fetchAll();
        return $this->objetos;
    }
}
?>
