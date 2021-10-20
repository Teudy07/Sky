<?php

class ContactoController {
    static public function getContactos($parametro) {
        $resultado = ContactoModel::getContactos($parametro);
        return $resultado;
    }

    static public function getContacto() {
        $idContacto = $_GET['idContacto'];        
        $resultado = ContactoModel::getContacto($idContacto);
        echo json_encode($resultado);
    }

    static public function actualizarContacto()  {

        $datos = array(
            "idContacto" => $_POST['idContacto'],
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

        $resultados = ContactoModel::actualizarContacto($datos);
        
        echo  json_encode(array(
            "success" => $resultados > 0 ? true : false, 
            "msg" => $resultados > 0 ? "Se ha actualizado de forma correcta" : "Ah ocurrido un error interno!!" 
        ));
        // print_r($resultados);
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

        echo  json_encode(array(
            "success" => $resultado > 0 ? true : false, 
            "msg" => $resultado > 0 ? "Se ha registrado de forma correcta" : "Ah ocurrido un error interno!!" 
        ));
        // if($resultado == 0) {
        //     echo json_encode(
        //         array(
        //             "error" => true,
        //             "exec" => "registro",
        //             "msg" => "Ah ocurrido un error",
        //         )
        //     ); 
        // } else {
        //     echo json_encode(
        //         array(
        //             "success" => true,
        //             "exec" => "registro",
        //             "msg" => "Se ha registrado de forma correcta",
        //         )
        //     );
        // }
    } 


    ///here
    static public function getProvincia() {
    
        $idPais = $_GET['idPais'];
      
        $resultado = ContactoModel::getProvincia($idPais);
       
        $html = '<option value="">Seleccione una opción</option>';

        foreach($resultado as $key) {
            $html .= "<option value='". $key['idprovincia'] ."'>". $key['descripcion'] ."</option>";
        }

        echo json_encode(array("html" => $html));
        
    }
}