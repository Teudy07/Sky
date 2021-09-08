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
        //    print_r($datos);
           echo "desde el controlador";

           $exec->beginTransaction();
            $exec->exec("INSERT INTO tercero VALUES()");
            $idTercero =  $exec->lastInsertId();

            $exec->exec("INSERT INTO persona(idTercero,nombre, apellido, idSexo, idTipoIdentificacion, identificacion)
             VALUES($idTercero, '". $datos["nombre"] ."', '". $datos["apellido"] ."', ". $datos['sexo'] .", ". $datos['tipoIdentificacion'] .", '". $datos['identificacion'] ."')");
            $idPersona = $exec->lastInsertId();

            
            $exec->exec("INSERT INTO usuario(idPersona, idRol, usuario, clave, activo)
             VALUES($idPersona, ". $datos["rol"] .",'". $datos["usuario"] ."', '". $datos["clave"] ."', ". $datos['estado'] .")");
            $idUsuario = $exec->lastInsertId();

            // echo "INSERT INTO usuario(idRol,idPersona, usuario, clave, activo)
            // VALUES($idPersona, '". $datos["idRol"] ."', '". $datos["clave"] ."', ". $datos['estado'] .", ". $datos['tipoIdentificacion'] .", '". $datos['identificacion'] ."')";
           
            // echo "mostrando valor";
            // echo "IdTercero: [" . $idTercero . "]";
            // print_r($idTercero);
            $exec->commit();
            return  $idUsuario;

       } catch (PDOException $e) {
           //throw $th;
           $exec->rollBack();
           echo "Ah ocurrido un error: " . $e->getMessage();
           throw new Exception('internal-database-error');
       }

    }
}