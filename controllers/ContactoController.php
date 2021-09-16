<?php
class ContactoModel {
    static public function getContacto() {
        $resultado = ContactoModel::getContacto();
        return $resultado;
    }

    static public function registrarContacto() {
        if(isset($_POST['idTercero'])) {

            $datos = array(
                "nombre" => $_POST['nombre'],
                "apellido" => $_POST['apellido'],
                "tipoIdentificacion" => $_POST['tipoIdentificacion'],
                "identificacion" => $_POST['identificacion'],
                "sexo" => $_POST['sexo'],
                "correo" => $_POST['correo'],
                "telefono" => $_POST['telefono'],
                "rol" => $_POST['rol'],
                "usuario" => $_POST['usuario'],
                "clave" => $_POST['clave'],
                "estado" => $_POST['estado'],
            );
            
            // print_r($datos);
            $resultado = ContactoModel::registrarContacto($datos);
            $_POST = null;

            if($resultado > 0) {
                echo '<script>
                Swal.fire(
                    "Notificacion!",
                    "Se ha registrado de forma correcta!",
                    "success"
                );
                </script>';
            } else if($resultado == 0) {
                echo '<script>
                Swal.fire(
                    "Notificacion!",
                    "Ah ocurrido un errodo!",
                    "success"
                );
                </script>';
            }
            // print_r($resultado);
        }
    }
}