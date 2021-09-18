<?php

class ContactoController {
    public function getContacto($parametro) {
        $resultado = ContactoModel::getContacto($parametro);
        return $resultado;
    }
    
    static public function hola() {
        echo "Hola desde el controlador";
    }


    static public function registrarContacto() {
        $datos = array(
            "nombre" => $_POST['nombre'],
            "razonSocial" => $_POST['razonSocial'],
            "tipoIdentificacion" => $_POST['tipoIdentificacion'],
            "identificacion" => $_POST['identificacion'],
            "correo" => $_POST['correo'],
            "telefono" => $_POST['telefono'],
            "esCliente" => isset($_POST['esCliente']) ? $_POST['esCliente'] : 0,
            "esProveedor" => isset($_POST['esProveedor']) ? $_POST['esProveedor'] : 0,
            "estado" => $_POST['estado'],
        );
        $contacto = new ContactoModel();
        $resultado = $contacto->registrarContacto($datos);

        if($resultado == 0) {
            echo json_encode(
                array(
                    "error" => true,
                    "exec" => "registro",
                    "msg" => "Ah ocurrido un error",
                )
            ); 
        } else {
            echo json_encode(
                array(
                    "ssucess" => true,
                    "exec" => "registro",
                    "msg" => "Se ha registrado de forma correcta",
                )
            );
        }
    } 
}