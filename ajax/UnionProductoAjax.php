<?php 

require_once "../models/ConsultaModel.php";
require_once "../models/ProductoModel.php";

    
class UnionProductoAjax {

    public function getMarca() {
        $idmarca = $_POST['idmarca'];
        $respuesta = ConsultaModel::getDatos('marca', 'idmarca', $idmarca);
        echo  json_encode($respuesta[0]);
    }

    public function eliminarMarca() {
        $idmarca = $_POST['idmarca'];

        // print_r($_POST);die;
        $respuesta = ProductoModel::eliminarMarca($idmarca);
        // print_r($respuesta);die;
        if($respuesta == true) {
            echo json_encode(
                array(
                    "success" => true,
                    "exec" => "eliminarMarca",
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

    public function actualizarMarca() {
        $datos = array(
            "idmarca" => $_POST['idmarca'],
            "descripcion" => $_POST['descripcion'],
            "estado" => $_POST['estado'],
        );

        $resultado = ProductoModel::actualizarMarca($datos);

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

    public function registrarMarca() {
 
            $datos = array(
                "descripcion" => $_POST['descripcion'],
                "estado" => $_POST['estado'],
            );
            $resultado = ProductoModel::registrarMarca($datos);
            
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

// print_r($_GET);
// print_r($_POST);
// die;
if(isset($_GET['exec']) && !empty($_GET['exec'])) {
    $funcion = $_GET['exec'];
    $ejecutar = new UnionProductoAjax();
    // echo $funcion;
    switch ($funcion) {
        case 'actualizarMarca':
            $ejecutar->actualizarMarca();
            break;
    
        case 'registrarMarca':
            $ejecutar->registrarMarca();
            break;
        case 'getMarca':
            $ejecutar->getMarca();
            break;

        case 'eliminarMarca':
            $ejecutar->eliminarMarca();
            break;
        default:
            echo "defaui";
            # code...
            break;
    }

}