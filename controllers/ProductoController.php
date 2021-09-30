<?php

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
                                    <li><a href="javascript:;" class="editarMarca" idmarca="' . $key["idmodelo"] . '" data-toggle="modal" data-target="#registroProductoModal">
                                            <i class="icon-pencil6 ">
                                            </i> Editar</a></li>
                                    <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified" class="bg-danger eliminarMarca" idmarca="' . $key["idmarca"] . '">
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

}
