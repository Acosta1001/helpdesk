<?php
include_once 'Conexion.php';

class Software {
    var $objetos;
    var $acceso;

    public function __construct(){
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    //----------------------------//
    //Funcion Crear               //
    //----------------------------//
    public function Crear ($producto,$licencia,$version1,$cantidad){
        $sql = "INSERT INTO software (producto_soft,num_licencia_soft, cant_soft) VALUE (:producto, :licencia, :version1,:cantidad)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(
                                ':nombre'=>$nombre,
                                ':licencia'=>$licencia,
                                ':version1'=>$version1,
                                ':cantidad'=>$cantidad
                            )
                        );    
        echo 'add';
    }  

    //-----------------------------------------------------------
    // Editar
    //-----------------------------------------------------------
    function Editar($id, $producto){
        $sql = "UPDATE software SET producto_soft=:producto 
                WHERE id_soft = :id";        
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$producto));
        echo 'update';
    }

    //-----------------------------------------------------------
    // Eliminar
    //-----------------------------------------------------------
    function Eliminar($id){
        $sql = "DELETE FROM software WHERE id_soft = :id";        
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
            $sql = "SELECT * FROM software WHERE producto_soft LIKE :consulta";      
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%"));
            $this->objetos = $query->fetchall();
        }
        else{
            $sql = "SELECT * FROM software WHERE producto_soft NOT LIKE '' ORDER BY id_soft";          
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
        $sql = 'SELECT * FROM software WHERE id_soft = :id';
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}
?>