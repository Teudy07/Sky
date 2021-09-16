<?php

require_once "Conexion.php";

class UsuarioModel {
    static public function getUsuario($item = null, $vale = null) {
        $respuesta = Conexion::conecion()->prepare("SELECT v.idUsuario, v.rol, v.usuario, v.clave, v.nombre, v.apellido, v.sexo, v.estado FROM usuario_v v");
        $respuesta->execute();
        return $respuesta->fetchAll();
    }

    static public function registrarUsuario($datos) {
        $exec = Conexion::conecion();
        
       try {
           //code...

           $exec->beginTransaction();
            $exec->exec("INSERT INTO tercero VALUES()");
            $idTercero =  $exec->lastInsertId();

            $exec->exec("INSERT INTO persona(idTercero,nombre, apellido, idSexo)
             VALUES($idTercero, '". $datos["nombre"] ."', '". $datos["apellido"] ."', ". $datos['sexo'] .")");
            $idPersona = $exec->lastInsertId();

            $exec->prepare("INSERT INTO identificacion(idTercero, idTipoIdentificacion, Identificacion)
            VALUES($idTercero, ". $datos["tipoIdentificacion"] .", '". $datos["identificacion"] ."')")->execute();

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

            // echo "INSERT INTO persona(idTercero,nombre, apellido, idSexo, idTipoIdentificacion, identificacion)
            // VALUES($idTercero, '". $datos["nombre"] ."', '". $datos["apellido"] ."', ". $datos['sexo'] .", ". $datos['tipoIdentificacion'] .", '". $datos['identificacion'] ."')";

            // echo "INSERT INTO usuario(idPersona, idRol, usuario, clave, activo)
            // VALUES($idPersona, ". $datos["rol"] .",'". $datos["usuario"] ."', '". $datos["clave"] ."', ". $datos['estado'] .")";

            $exec->exec("INSERT INTO usuario(idPersona, idRol, usuario, clave, activo)
             VALUES($idPersona, ". $datos["rol"] .",'". $datos["usuario"] ."', '". $datos["clave"] ."', ". $datos['estado'] .")");
            $idUsuario = $exec->lastInsertId();

            $exec->commit();
            return  $idUsuario;

       } catch (PDOException $e) {
           //throw $th;
           $exec->rollBack();
           echo "Ah ocurrido un error: " . $e->getMessage();
           throw new Exception('internal-database-error');
       }
    }

    static public function actualizarUsuario($datos) {
        

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

    //    print_r($records);
        $idTercero = $records[0]['idTercero'];
        $idTelefono = $records[0]['idTelefono'];
        $idCorreo = $records[0]['idCorreo'];
        $idIdentificacion = $records[0]['idIdentificacion'];
        $idPersona = $records[0]['idPersona'];

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
                                            p.idSexo = ". $datos['sexo'] ."
                                          WHERE p.idPersona = ". $idPersona ."")->execute();

           $data = Conexion::conecion()->prepare("UPDATE usuario u SET u.idRol = ". $datos['rol'] .", u.usuario = '". $datos['usuario'] ."', u.clave = '". $datos['clave'] ."', u.activo = ". $datos['estado'] ." 
           WHERE u.idUsuario = ". $datos['idUsuario'] ."")->execute();

           return $data;
       }
        
    }

    static public function eliminarUsuario($idUsuario) {
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
    }
}