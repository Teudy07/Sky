<?php 

require_once "../models/ConsultaModel.php";
class UsuarioAjax {

    public function getUsuario() {
        $idUsuario = $_POST['idUsuario'];
        $respuesta = ConsultaModel::getDatos('usuario_v', 'idUsuario', $idUsuario);
        echo  json_encode($respuesta);
    }

    public function actualizarUsuario() {
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
            "confirmarClave" => $_POST['confirmarClave'],
            "estado" => $_POST['estado'],
        );

        echo json_encode($_POST);
    } 
}


if(isset($_POST['exec']) && !empty($_POST['exec'])) {
    $funcion = $_POST['exec'];
    $ejecutar = new UsuarioAjax();
    switch ($funcion) {
        case 'actualizarUsuario':
            $ejecutar->actualizarUsuario();
            break;
    
        case 'getUsuario':
            $ejecutar->getUsuario();
            break;
        default:
            echo "defaui";
            # code...
            break;
    }

}