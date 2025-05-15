<?php
include_once 'Conexion.php';

class Estado {
    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //----------------------------//
    //Funcion Crear               //
    //----------------------------//
    public function Crear ($id,$nombre){
        $sql = "INSERT INTO proveedor (id_prove,nom_prove) VALUE (:id,nombre)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre));   
        echo 'add';
    }  

    //-----------------------------------------------------------
    // Editar
    //-----------------------------------------------------------
    function Editar($id, $nombre){
        $sql = "UPDATE proveedor SET nom_prove=:nombre 
                WHERE id_prove = :id";        
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        echo 'update';
    }

    //-----------------------------------------------------------
    // Eliminar
    //-----------------------------------------------------------
    function Eliminar($id){
        $sql = "DELETE FROM proveedor WHERE id_prove= :id";        
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        if(!empty($query->execute(array(':id'=>$id))))
            echo 'eliminado';
        else 
            echo 'noeliminado';
    }

    //-----------------------------------------------------------
    // Buscar los registros segun criterio de busqueda en consulta
    //-----------------------------------------------------------
    function BuscarTodos($consulta){
        if(!empty($consulta)){                
            $sql = "SELECT * FROM proveedor WHERE nom_prove LIKE :consulta";      
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos = $query->fetchall();
        }
        else{
            $sql = "SELECT * FROM proveedor WHERE nom_prove NOT LIKE '' ORDER BY id_prove";          
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
        }
        //Retorna la consulta
        return $this->objetos;    
    }

    //--------------------------------
    //Busca un usuario segun el ID
    //--------------------------------
    function Buscar($id){
        $sql = 'SELECT * FROM proveedor WHERE id_prove = :id';
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>