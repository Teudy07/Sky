<?php

require_once "Conexion.php";

class UsuarioModel {
    static public function getUsuario($item = null, $vale = null) {
        $respuesta = Conexion::conecion()->prepare("SELECT v.idUsuario, v.rol, v.usuario, v.clave, v.nombre, v.apellido, v.sexo, v.estado FROM usuario_v v");
        $respuesta->execute();
        return $respuesta->fetchAll();
    }

    static public function registrarUsuario($data) {
        try {
            
            // $respuesta = Conexion::conecion()->beginTransaction();
            // $respuesta->exec("INSERT INTO persona(nombre, apellido, apodo, )");
            // $respuesta->rollBack();
        } catch (Throwable $th) {
            // $respuesta->
        }
    }
}