<?php

require_once "Conexion.php";

class ProductoModel {
    public function hola() {
        echo "hola modelo";
    }
    static public function getMarcas() {

        // echo $condicion;
        $respuesta = Conexion::conecion()->prepare("
        SELECT 
            m.idmarca,
            m.descripcion AS marca,
            m.creado_en,
            m.creado_por,
            CASE WHEN m.estado IS TRUE THEN 1 ELSE 0 END AS activo 
        FROM marca m
        ");
        $respuesta->execute();
        return $respuesta->fetchAll();
    }


    ///modelos
    static public function getModelos() {

        // echo $condicion;
        $respuesta = Conexion::conecion()->prepare("
        SELECT md.idmodelo, 
            md.idmarca,
            mc.descripcion AS marca, 
            md.descripcion AS modelo, 
            md.creado_en,
            md.creado_por,
            CASE WHEN md.estado IS TRUE THEN 1 ELSE 0 END AS activo 
        FROM modelo md
        INNER JOIN marca mc ON mc.idmarca = md.idmarca;
        ");
        $respuesta->execute();
        return $respuesta->fetchAll();
    }

    static public function registrarMarca($datos) {
        $exec = Conexion::conecion();
        
        try {  
                $exec->beginTransaction();
                $idmarca = 0;

                if(isset($datos["marca"]) && !empty($datos["marca"])) {
                $exec->exec("INSERT INTO marca(descripcion, creado_por)
                VALUES('". $datos["marca"] ."', ". $datos['creado_por'] .")");
                $idmarca = $exec->lastInsertId();
            }
            $exec->commit();
            return  $idmarca;
        } catch (PDOException $e) {
           //throw $th;
           $exec->rollBack();
           echo "Ah ocurrido un error: " . $e->getMessage();
           throw new Exception('internal-database-error');
        }
    }

    static public function registrarModelo($datos) {
        // print_r($datos);
        // die;
        $exec = Conexion::conecion();
        
        try {  
                $exec->beginTransaction();
                $idmodelo = 0;

                if(isset($datos["marca"]) && !empty($datos["marca"])) {
                $exec->exec("INSERT INTO modelo(idmarca, descripcion, creado_por, estado)
                VALUES(". $datos["marca"] .",'". $datos["modelo"] ."', ". $datos['creado_por'] .", ". $datos['estado']  .")");
                $idmodelo = $exec->lastInsertId();
            }
            $exec->commit();
            return  $idmodelo;
        } catch (PDOException $e) {
           //throw $th;
           $exec->rollBack();
           echo "Ah ocurrido un error: " . $e->getMessage();
           throw new Exception('internal-database-error');
        }
    }
    

    static public function actualizarMarca($datos) {
        

        $respuesta = Conexion::conecion()->prepare("
        SELECT * 
        FROM marca
        WHERE u.idmarca = ". $datos['idmarca'] ."
        LIMIT 1");
        $respuesta->execute();
        $records = $respuesta->fetchAll();

        Conexion::conecion()->prepare("UPDATE marca m 
                                            SET m.descripcion = '". $datos['descripcion'] ."', 
                                          WHERE m.idmarca = ". $records[0]['idmarca'] ."")->execute();

           return $datos;
       }

    


    static public function eliminarMarca($idmarca) {
        $respuesta = Conexion::conecion()->prepare("
        SELECT * 
        FROM marca
        WHERE u.idmarca = ". $idmarca['idmarca'] ."
        LIMIT 1");
        $respuesta->execute();
        $records = $respuesta->fetchAll();


       if(count($records) > 0) {

            Conexion::conecion()->prepare("DELETE FROM marca WHERE idmarca = $idmarca")->execute();
       }

       return (count($records) > 0) ? true : false;
       }
}
