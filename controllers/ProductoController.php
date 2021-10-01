<?php

// session_start();

class ProductoController {
    /**
     * @descripcion Genera los records en la tabla
     * @return
     */
    static public function getMarcas() {
        $resultado = ProductoModel::getMarcas();
        $html = '<thead>
                    <tr>
                        <th>#</th>
                        <th>Marca</th>
                        <th>Creado En</th>
                        <th>Creado Por</th>
                        <th>Estado</th>
                        <th class="text-left">Acciones</th>
                    </tr>
                </thead>';

        foreach ($resultado as $index => $key) {
            $indice = $index + 1;
            $estado  = ($key["activo"] == 1) ? '<span class="label label-success label-rounded">
            <span class="text-bold">ACTIVO</span>
                </span>' : '<span class="label label-danger label-rounded">
                <span class="text-bold">INACTIVO</span>';

            $indice = $index + 1;
            $html.= '<tr>
                    <td> ' .  $indice . ' </td>
                    <td> ' . $key["marca"] . ' </td>
                    <td> ' . $key["creado_en"] . ' </td>
                    <td> ' . $key["creado_por"] . ' </td>
                    <td> ' . $estado . ' </td>

                    <td> 
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                        
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:;" class="editarMarca" idmarca="' . $key["idmarca"] . '" data-toggle="modal" data-target="#ModalformularioMarca">
                                            <i class="icon-pencil6 ">
                                            </i> Editar</a></li>
                                 <!-- <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified" class="bg-danger eliminarMarca eliminar" idmarca="' . $key["idmarca"] . '">
                                            <i class=" icon-trash">
                                            </i> Eliminar</a></li> -->
                                </ul>
                            </li>
                        </ul> 
                    </td>
                </tr>';
            }

        return $html;
    }

    static public function getModelos() {
        // echo "naruto asdfasdf";die;

        $resultado = ProductoModel::getModelos();


        $html = '<thead>
                    <tr>
                        <th>#</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Creado En</th>
                        <th>Creado Por</th>
                        <th>Estado Por</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>';

        foreach ($resultado as $index => $key) {
            $indice = $index + 1;
            $estado  = ($key["activo"] == 1) ? '<span class="label label-success label-rounded">
            <span class="text-bold">ACTIVO</span>
                </span>' : '<span class="label label-danger label-rounded">
                <span class="text-bold">INACTIVO</span>';

            $indice = $index + 1;
            $html.= '<tr>
                    <td> ' .  $indice . ' </td>
                    <td> ' . $key["marca"] . ' </td>
                    <td> ' . $key["modelo"] . ' </td>
                    <td> ' . $key["creado_en"] . ' </td>
                    <td> ' . $key["creado_por"] . ' </td>
                    <td> ' . $estado . ' </td>

                    <td> 
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                </a>
                        
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:;" class="editarContacto" idModelo="' . $key["idmodelo"] . '" data-toggle="modal" data-target="#ModalformularioModelo">
                                            <i class="icon-pencil6 ">
                                            </i> Editar</a></li>
                                   <!-- <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified" class="bg-danger eliminarModelo eliminar " idModelo="' . $key["idmodelo"] . '">
                                            <i class=" icon-trash">
                                            </i> Eliminar</a></li> -->
                                </ul>
                            </li>
                        </ul> 
                    </td>
                </tr>';
            }

        return $html;
    }

    static public function registrarModelo() {
        // print_r($_SESSION);
        // print_r($_GET);
        // print_r($_POST);

        // die;
        $datos = array(
            "marca" => $_POST['marca'],
            "modelo" => $_POST['modelo'],
            "creado_por" => $_SESSION['idUsuario'],
            "estado" => $_POST['estado'],
        );
        // print_r($datos);

        $resultado = ProductoModel::registrarModelo($datos);
        // print_r($resultado);

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

    static public function registrarMarca() {
        // print_r($_SESSION);
        // print_r($_GET);
        // print_r($_POST);
        $datos = array(
            "marca" => $_POST['marca'],
            "creado_por" => $_SESSION['idUsuario'],
            "estado" => $_POST['estado'],
        );
        // print_r($datos);

        $resultado = ProductoModel::registrarMarca($datos);
        // print_r($resultado);

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

    public function eliminarMarca() {

        print_r($_GET);
        print_r($_POST);
        die;
        // $idUsuario = $_POST['idUsuario'];

        // print_r($_POST);die;
        // $respuesta = ProductoModel::registrarMarca($idUsuario);
        // // print_r($respuesta);die;
        // if($respuesta == true) {
        //     echo json_encode(
        //         array(
        //             "success" => true,
        //             "exec" => "eliminarUsuario",
        //             "msg" => "Se ha eliminado de forma correcta!!",
        //         )
        //     );
        // } else {
        //     echo json_encode(
        //         array(
        //             "error" => true,
        //             "exec" => "actualizacion",
        //             "msg" => "Ah ocurrido un error",
        //         )
        //     );
        // }
    }

    public function eliminarModelo() {
        print_r($_GET);
        print_r($_POST);
        die;
        $idUsuario = $_POST['idUsuario'];

        // print_r($_POST);die;
        // $respuesta = UsuarioModel::eliminarUsuario($idUsuario);
        // // print_r($respuesta);die;
        // if($respuesta == true) {
        //     echo json_encode(
        //         array(
        //             "success" => true,
        //             "exec" => "eliminarUsuario",
        //             "msg" => "Se ha eliminado de forma correcta!!",
        //         )
        //     );
        // } else {
        //     echo json_encode(
        //         array(
        //             "error" => true,
        //             "exec" => "actualizacion",
        //             "msg" => "Ah ocurrido un error",
        //         )
        //     );
        // }
    }

}
