<?php

require_once "Conexion.php";

class ContactoModel {
    public function hola() {
        echo "hola modelo";
    }
    public function getContacto($parametro) {
        $condicion = '';

        if($parametro->todo === false) {
            if($parametro->esCliente) {
                $condicion = " AND c.esCliente IS TRUE ";
            } elseif($parametro->esProveedor) {
                $condicion = " AND c.esProveedor IS TRUE ";
            }
        }

        // echo $condicion;
        $respuesta = Conexion::conecion()->prepare("
        SELECT 
            c.idContacto, 
            c.nombre, 
            c.razonSocial AS razon_social, 
            CASE WHEN c.esCliente IS TRUE THEN 1 ELSE 0 END esCliente,
            CASE WHEN c.esProveedor IS TRUE THEN 1 ELSE 0 END esProveedor,
            c1.descripcion AS correo,
            t.descripcion AS telefono,
            tp.nombre AS tipoIdentificacion,
            i.Identificacion AS identificacion,
            CASE WHEN c.estado IS TRUE THEN 1 ELSE 0 END estado 
        FROM contacto c 
        INNER JOIN identificacion i ON c.idTercero = i.idTercero
        INNER JOIN tipo tp ON i.idTipoIdentificacion = tp.idtipo
        LEFT JOIN tercero_correo tc ON tc.idTercero = c.idTercero
        LEFT JOIN correo c1 ON tc.idCorreo = c1.idCorreo
        LEFT JOIN tercero_telefono tt ON tt.idTercero = c.idTercero
        LEFT JOIN telefono t ON tt.idTelefono = t.idTelefono
        WHERE 1 = 1 $condicion
        ");
        $respuesta->execute();
        return $respuesta->fetchAll();
    }

<<<<<<< HEAD
=======

>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
    static public function registrarContacto($datos) {
        $exec = Conexion::conecion();
        
       try {
           //code...

           $exec->beginTransaction();
            $exec->exec("INSERT INTO tercero VALUES()");
            $idTercero =  $exec->lastInsertId();

            $stmt = $exec->prepare("INSERT INTO contacto(idTercero, esCliente, esProveedor, nombre, razonSocial, estado)
             VALUES(:idTercero, :esCliente, :esProveedor, :nombre, :razonSocial, :estado)");
             $stmt->bindParam(":idTercero", $idTercero, PDO::PARAM_INT);
             $stmt->bindParam(":esCliente", $datos['esCliente'], PDO::PARAM_BOOL);
             $stmt->bindParam(":esProveedor", $datos['esProveedor'], PDO::PARAM_BOOL);
             $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
             $stmt->bindParam(":razonSocial",$datos['razonSocial'], PDO::PARAM_STR);
             $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_BOOL);
             $stmt->execute();
            $idContacto = $exec->lastInsertId();

            $stmt = $exec->prepare("INSERT INTO identificacion(idTercero, idTipoIdentificacion, Identificacion)
            VALUES(:idTercero, :tipoIdentificacion, :identificacion)");
             $stmt->bindParam(":idTercero", $idTercero, PDO::PARAM_INT);
             $stmt->bindParam(":tipoIdentificacion", $datos['tipoIdentificacion'], PDO::PARAM_INT);
             $stmt->bindParam(":identificacion", $datos['identificacion'], PDO::PARAM_INT);
            $stmt->execute();

            if(isset($datos["telefono"]) && !empty($datos["telefono"])) {
                $exec->exec("INSERT INTO telefono(descripcion)
                VALUES('". $datos["telefono"] ."')");
                $idTelefono = $exec->lastInsertId();

                $exec->exec("INSERT INTO tercero_telefono(idTercero, idTelefono)
                VALUES($idTercero, $idTelefono)");
            }

            if(isset($datos["correo"]) && !empty($datos["correo"])) {
                $exec->exec("INSERT INTO correo(descripcion)
                VALUES('". $datos["correo"] ."')");
                $idCorreo = $exec->lastInsertId();

                $exec->exec("INSERT INTO tercero_correo(idTercero, idCorreo)
                VALUES($idTercero, $idCorreo)");
            }

<<<<<<< HEAD
=======
            // echo "INSERT INTO persona(idTercero,nombre, apellido, idSexo, idTipoIdentificacion, identificacion)
            // VALUES($idTercero, '". $datos["nombre"] ."', '". $datos["apellido"] ."', ". $datos['sexo'] .", ". $datos['tipoIdentificacion'] .", '". $datos['identificacion'] ."')";

            // echo "INSERT INTO usuario(idPersona, idRol, usuario, clave, activo)
            // VALUES($idPersona, ". $datos["rol"] .",'". $datos["usuario"] ."', '". $datos["clave"] ."', ". $datos['estado'] .")";

            $exec->exec("INSERT INTO contacto(idTercero, esCliente, esProveedor, nombre, razonsocial, estado)
             VALUES($idTercero, ". $datos["esCliente"] .",'". $datos["esProveedor"] ."', '". $datos["nombre"] ."', '". $datos["razonsocial"] ."', ". $datos['estado'] .")");
            $idContacto = $exec->lastInsertId();

>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
            $exec->commit();
            return  $idContacto;

       } catch (PDOException $e) {
           //throw $th;
           $exec->rollBack();
           echo "Ah ocurrido un error: " . $e->getMessage();
           throw new Exception('internal-database-error');
       }
    }
<<<<<<< HEAD

    static public function actualizarContacto($datos) {
=======
/*
    static public function actualizarUsuario($datos) {
>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
        

        $respuesta = Conexion::conecion()->prepare("
        SELECT 
            u.usuario,
            p.idPersona,
            p.idTercero,
            COALESCE(i.idIdentificacion,0) AS idIdentificacion,
            COALESCE(tt.idTelefono,0) AS idTelefono,
            COALESCE(tc.idCorreo,0) AS idCorreo
        FROM usuario u 
        INNER JOIN persona p ON p.idPersona = u.idPersona
        LEFT JOIN tercero_telefono tt ON tt.idTercero = p.idTercero
        LEFT JOIN tercero_correo tc ON tc.idTercero = p.idTercero
        LEFT JOIN identificacion i ON i.idTercero = p.idTercero
        WHERE u.idUsuario = ". $datos['idUsuario'] ."
        LIMIT 1");
        $respuesta->execute();
       $records = $respuesta->fetchAll();

        $idTercero = $records[0]['idTercero'];
        $idTelefono = $records[0]['idTelefono'];
        $idCorreo = $records[0]['idCorreo'];
        $idIdentificacion = $records[0]['idIdentificacion'];

       if(count($records) > 0) {
        if($idIdentificacion > 0) {
            Conexion::conecion()->prepare("UPDATE identificacion SET Identificacion = '". $datos['identificacion'] ."' WHERE idIdentificacion = ". $idIdentificacion ."")->execute();
       } else {
            $stmt = Conexion::conecion();
            $stmt->prepare("INSERT INTO identificacion(idTercero, idTipoIdentificacion, Identificacion)
            VALUES($idTercero, ". $datos["tipoIdentificacion"] .", '". $datos["identificacion"] ."')")->execute();
        }

           if($records[0]['idTelefono'] > 0) {
                Conexion::conecion()->prepare("UPDATE telefono SET descripcion = '". $datos['telefono'] ."' WHERE idTelefono = ". $idTelefono ."")->execute();
           } else {
               $stmt = Conexion::conecion();
                $respuesta = $stmt->prepare("INSERT INTO telefono(descripcion)
                VALUES('". $datos["telefono"] ."')")->execute();
                $idTelefono = $stmt->lastInsertId();

                $stmt->prepare("INSERT INTO tercero_telefono(idTercero, idTelefono)
                VALUES($idTercero, $idTelefono)")->execute();
           }


           if($records[0]['idCorreo'] > 0) {
                Conexion::conecion()->prepare("UPDATE correo SET descripcion = '". $datos['correo'] ."' WHERE idCorreo = ". $idCorreo ."")->execute();
           } else {
                $stmt = Conexion::conecion();
                $respuesta = $stmt->prepare("INSERT INTO correo(descripcion)
                VALUES('". $datos["correo"] ."')")->execute();
                $idCorreo = $stmt->lastInsertId();

                $stmt->prepare("INSERT INTO tercero_correo(idTercero, idCorreo)
                VALUES($idTercero, $idCorreo)")->execute();
            }

           Conexion::conecion()->prepare("UPDATE persona p 
                                            SET p.nombre = '". $datos['nombre'] ."', 
                                            p.apellido = '". $datos['apellido'] ."', 
                                            p.idSexo = ". $datos['sexo'] .", 
                                            p.idTipoIdentificacion = ". $datos['tipoIdentificacion'] .", 
                                            p.identificacion = '". $datos['identificacion'] ."' 
                                          WHERE p.idPersona = ". $records[0]['idPersona'] ."")->execute();

           $data = Conexion::conecion()->prepare("UPDATE usuario u SET u.idRol = ". $datos['rol'] .", u.usuario = '". $datos['usuario'] ."', u.clave = '". $datos['clave'] ."', u.activo = ". $datos['estado'] ." 
           WHERE u.idUsuario = ". $datos['idUsuario'] ."")->execute();

           return $data;
       }
        
    }

    static public function eliminarContacto($idUsuario) {
        $respuesta = Conexion::conecion()->prepare("
            SELECT 
                u.idUsuario,
                u.usuario,
                p.idPersona,
                p.idTercero,
                COALESCE(tt.idTelefono,0) AS idTelefono,
                COALESCE(tc.idCorreo,0) AS idCorreo
            FROM usuario u 
            INNER JOIN persona p ON p.idPersona = u.idPersona
            LEFT JOIN tercero_telefono tt ON tt.idTercero = p.idTercero
            LEFT JOIN tercero_correo tc ON tc.idTercero = p.idTercero
            WHERE u.idUsuario = ". $idUsuario ."
            LIMIT 1");
        $respuesta->execute();
        $records = $respuesta->fetchAll();

        $idUsuario = $records[0]['idUsuario'];
        $idPersona = $records[0]['idPersona'];
        $idTercero = $records[0]['idTercero'];
        $idTelefono = $records[0]['idTelefono'];
        $idCorreo = $records[0]['idCorreo'];

       if(count($records) > 0) {
           if($idTelefono > 0) {
                Conexion::conecion()->prepare("DELETE FROM tercero_telefono WHERE idTelefono = $idTelefono")->execute();
                Conexion::conecion()->prepare("DELETE FROM telefono WHERE idTelefono = $idTelefono")->execute();
           } 
           if($idCorreo > 0) {
                Conexion::conecion()->prepare("DELETE FROM tercero_correo WHERE idCorreo = $idCorreo")->execute();
                Conexion::conecion()->prepare("DELETE FROM correo WHERE idCorreo = $idCorreo")->execute();
            }

            Conexion::conecion()->prepare("DELETE FROM tercero WHERE idTercero = $idTercero")->execute();
            Conexion::conecion()->prepare("DELETE FROM persona WHERE idPersona = $idPersona")->execute();
            Conexion::conecion()->prepare("DELETE FROM usuario WHERE idUsuario = $idUsuario")->execute();
       }

       return (count($records) > 0) ? true : false;
<<<<<<< HEAD
       }
}
=======
       
    }
    */
}
>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
