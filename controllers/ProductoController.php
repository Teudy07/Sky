<?php

class ProductoController {
    static public function getMarcas() {
        $resultado = ProductoModel::getMarcas();
        $html = '<thead>
                    <tr>
                        <th>#</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Creado En</th>
                        <th>Creado Por</th>
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
                                    <li><a href="javascript:;" class="editarContacto" idModelo="' . $key["idModelo"] . '" data-toggle="modal" data-target="#registroContactoModal">
                                            <i class="icon-pencil6 ">
                                            </i> Editar</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified" class="bg-danger eliminarUsuario" idContacto="' . $key["idModelo"] . '">
                                            <i class=" icon-trash">
                                            </i> Eliminar</a></li>
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
                                    <li><a href="javascript:;" class="editarContacto" idModelo="' . $key["idModelo"] . '" data-toggle="modal" data-target="#registroContactoModal">
                                            <i class="icon-pencil6 ">
                                            </i> Editar</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified" class="bg-danger eliminarUsuario" idContacto="' . $key["idModelo"] . '">
                                            <i class=" icon-trash">
                                            </i> Eliminar</a></li>
                                </ul>
                            </li>
                        </ul> 
                    </td>
                </tr>';
            }

        return $html;
    }

    static public function getUsuario() {
        $resultado = UsuarioModel::getUsuario();
        return $resultado;
    }

    static public function registrarUsuario() {
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
                "estado" => $_POST['estado'],
            );
            
            // print_r($datos);
            $resultado = UsuarioModel::registrarUsuario($datos);
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