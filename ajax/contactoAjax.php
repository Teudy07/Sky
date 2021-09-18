<?php 

require_once "../models/ConsultaModel.php";
<<<<<<< HEAD
require_once "../models/UsuarioModel.php";

class UsuarioAjax {

    public function getUsuario() {
        $idUsuario = $_POST['idUsuario'];
        $respuesta = ConsultaModel::getDatos('usuario_v', 'idUsuario', $idUsuario);
        echo  json_encode($respuesta[0]);
    }

    public function eliminarUsuario() {
        $idUsuario = $_POST['idUsuario'];

        // print_r($_POST);die;
        $respuesta = UsuarioModel::eliminarUsuario($idUsuario);
=======
require_once "../models/ContactoModel.php";

// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// header("Allow: GET, POST, OPTIONS, PUT, DELETE");
//         header('Access-Control-Allow-Credentials: true');
//         header('Access-Control-Max-Age: 86400'); 

//         if (isset($_SERVER['HTTP_ORIGIN'])) {
//             header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//             header('Access-Control-Allow-Credentials: true');
//             header('Access-Control-Max-Age: 86400');
//             }
    
//     if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
//         if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
//             header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//         }
        
//         if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
//             header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//         }
//     }
    
class ContactoAjax {

    public function getContacto() {
        $idContacto = $_POST['idContacto'];
        $respuesta = ConsultaModel::getDatos('contacto', 'idContacto', $idContacto);
        echo  json_encode($respuesta[0]);
    }
/*
    public function eliminarUsuario() {
        $idUsuario = $_POST['idContacto'];

        // print_r($_POST);die;
        $respuesta = ContactoModel::eliminarUsuario($idContacto);
>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
        // print_r($respuesta);die;
        if($respuesta == true) {
            echo json_encode(
                array(
                    "success" => true,
                    "exec" => "eliminarUsuario",
                    "msg" => "Se ha eliminado de forma correcta!!",
                )
            );
        } else {
            echo json_encode(
                array(
                    "error" => true,
                    "exec" => "actualizacion",
                    "msg" => "Ah ocurrido un error",
                )
            );
        }
    }

    public function actualizarUsuario() {
        $datos = array(
            "idUsuario" => $_POST['idUsuario'],
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
            // "confirmarClave" => $_POST['confirmarClave'],
            "estado" => $_POST['estado'],
        );

        $resultado = UsuarioModel::actualizarUsuario($datos);

        if($resultado == 0) {
            echo json_encode(
                array(
                    "error" => true,
                    "exec" => "actualizacion",
                    "msg" => "Ah ocurrido un error",
                )
            ); 
        } else {
            echo json_encode(
                array(
                    "ssucess" => true,
                    "exec" => "actualizacion",
                    "msg" => "Se ha actualizado de forma correcta",
                )
            );
        }

    } 
<<<<<<< HEAD

    public function registrarUsuario() {

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
        $resultado = UsuarioModel::registrarUsuario($datos);
        
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
=======
*/
    public function registrarContacto() {
        if(isset($_POST['idTercero'])) {

            $datos = array(
                "nombre" => $_POST['nombre'],
                "apellido" => $_POST['apellido'],
                "tipoIdentificacion" => $_POST['tipoIdentificacion'],
                "identificacion" => $_POST['identificacion'],
                "sexo" => $_POST['sexo'],
                "correo" => $_POST['correo'],
                "telefono" => $_POST['telefono'],
                "estado" => $_POST['estado'],
            );
            $resultado = ContactoModel::registrarContacto($datos);
            
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
>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
        }
    } 
}

<<<<<<< HEAD
print_r($_GET);
print_r($_POST);
die;
if(isset($_GET['exec']) && !empty($_GET['exec'])) {
    $funcion = $_GET['exec'];
    $ejecutar = new UsuarioAjax();
    // echo $funcion;
    switch ($funcion) {
        case 'actualizarUsuario':
            $ejecutar->actualizarUsuario();
            break;
    
        case 'registrarUsuario':
            $ejecutar->registrarUsuario();
            break;
=======
// print_r($_GET);
// print_r($_POST);
// die;
if(isset($_GET['exec']) && !empty($_GET['exec'])) {
    $funcion = $_GET['exec'];
    $ejecutar = new ContactoAjax();
    // echo $funcion;
    switch ($funcion) {
       /* case 'actualizarUsuario':
            $ejecutar->actualizarContacto();
            break;*/
    
        case 'registrarContacto':
            $ejecutar->registrarContacto();
            break;
            /*
>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
        case 'getUsuario':
            $ejecutar->getUsuario();
            break;

        case 'eliminarUsuario':
            $ejecutar->eliminarUsuario();
<<<<<<< HEAD
            break;
=======
            break;*/
>>>>>>> ec89a64d5b7cf6146c5c3ebc75c9145fd6738019
        default:
            echo "defaui";
            # code...
            break;
    }

}