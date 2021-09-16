<?php
header('Access-Control-Allow-Origin: http://localhost/Sky/');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400'); 

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
            }
    
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        }
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";

// die;
// echo "hola";

#CONTRULLE LA PLANTILLA
require_once "controllers/TemplateController.php";
#CADENA DE CONEXION
require_once "models/Conexion.php";

#USUARIO
require_once "controllers/UsuarioController.php";
require_once "models/UsuarioModel.php";

#CONSULTA GENERAL
require_once "controllers/ConsultaController.php";
require_once "models/ConsultaModel.php";

#Contacto
require_once "controllers/UsuarioController.php";
require_once "models/UsuarioModel.php";


$template = new TemplateController();
$template->template();
