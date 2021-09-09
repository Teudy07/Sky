<?php 

require_once "../models/ConsultaModel.php";
require_once "../models/UsuarioModel.php";

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
        // print_r($respuesta);
        if($respuesta == true) {
            echo json_encode(
                array(
                    "ssucess" => true,
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
            "confirmarClave" => $_POST['confirmarClave'],
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

    public function registrarUsuario() {
        if(isset($_POST['usuario'])) {

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
            }
        }
    } 
}

// print_r($_GET);
// print_r($_POST);
// die;
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
        case 'getUsuario':
            $ejecutar->getUsuario();
            break;

        case 'eliminarUsuario':
            $ejecutar->eliminarUsuario();
            break;
        default:
            echo "defaui";
            # code...
            break;
    }

}