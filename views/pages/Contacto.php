<div class="panel panel-flat">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="index.php?route=contacto"><i class="icon-home2 position-left"></i> Inicio</a></li>
            <li><a href="javascript:;"> <?php

                                        $titulo = '';

                                        if (!empty($_GET['type']) && isset($_GET['type']) && ($_GET['type'] === 'cliente' || $_GET['type'] === 'proveedor')) {
                                            $titulo = trim($_GET['type']);
                                        } else {
                                            $titulo = "Contacto";
                                        }
                                        echo $titulo;
                                        ?>
                </a></li>
        </ul>
    </div>

    <div class="panel-heading">
        <h5 class="panel-title"><?php echo $titulo ?></h5>
        <div class="heading-elements">
            <button type="button" class="btn btn-primary heading-btn" id="btnRegistrar" data-toggle="modal" data-target="#registroContactoModal">
                <i class="icon-database-add"></i> Agregar Nuevo <?php echo $titulo ?></button>
        </div>
    </div>
</div>

<div id="reload-div">
    <table id="tbContacto" class="table datatable-basic table-xxs table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Razon Social</th>
                <th>Identificacion</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $parametro = new stdClass();
            $parametro->esProveedor = false;
            $parametro->esCliente = false;
            $parametro->todo = false;

            if($titulo === "proveedor") {
                $parametro->esProveedor = true;
            } else if($titulo === "cliente") {
                $parametro->esCliente = true;
            } else {
                $parametro->todo = true;
            }

            $contacto = new ContactoController();
            $resultados = $contacto->getContacto($parametro);
            // print_r($_GET);
            foreach ($resultados as $index => $key) {
                $indice = $index + 1;
                $estado  = ($key["estado"] == 1) ? '<span class="label label-success label-rounded">
                <span class="text-bold">ACTIVO</span>
                    </span>' : '<span class="label label-danger label-rounded">
                    <span class="text-bold">INACTIVO</span>';

                $indice = $index + 1;
                echo '<tr>
                        <td> ' .  $indice . ' </td>
                        <td> ' . $key["nombre"] . ' </td>
                        <td> ' . $key["razon_social"] . ' </td>
                        <td> ' . $key["identificacion"] . ' </td>
                        <td> ' . $key["correo"] . ' </td>
                        <td> ' . $key["telefono"] . ' </td>
                        <td> ' . $estado . ' </td>

                        <td> 
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                            
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:;" class="editarContacto" idContacto="' . $key["idContacto"] . '" data-toggle="modal" data-target="#registroContactoModal">
                                                <i class="icon-pencil6 ">
                                                </i> Editar</a></li>
                                        <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified" class="bg-danger eliminarUsuario" idContacto="' . $key["idContacto"] . '">
                                                <i class=" icon-trash">
                                                </i> Eliminar</a></li>
                                    </ul>
                                </li>
                            </ul> 
                        </td>
                        </tr>';
            }
            ?>

        </tbody>
    </table>
</div>

<!-- MODAL REGISTRAR PRODUCTO-->
<div class="modal fade " id="registroContactoModal" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formRegistrarContacto" method="post">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="titulo"><?php echo "Registrar nuevo " . $titulo ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="idConsorcio" id="idConsorcio">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese el nombre" value="Teudy Soluciones" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Razon Social</label>
                                            <input type="text" name="razonSocial" class="form-control" id="razonSocial" placeholder="Ingrese la razon social" value="Teudy Soluciones S.R.L">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Tipo Identificacion</label>
                                            <select class="form-control select2bs4" name="tipoIdentificacion" id="tipoIdentificacion" required>
                                                <option value="" disabled selected>Seleccione una opcion</option>
                                                <?php
                                                $identificacion = ConsultaController::getDatos("tipo", "tipo", "identificacion");
                                                foreach ($identificacion as $index => $key) {
                                                    echo "<option value=" . $key['idtipo'] . " >" . $key['nombre'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Identificacion</label>
                                            <input type="text" name="identificacion" class="form-control" id="identificacion" placeholder="identificacion"  value="03158468464" required>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- <hr Style='background-color: black'> -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Correo</label>
                                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo electronico" value="corre@asdf.com" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Telefono</label>
                                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Numero telefonico" value="829-555-9999" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Referencia</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="esCliente" id="esCliente" value="1">
                                            <label class="form-check-label" for="esCliente">Cliente</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="esProveedor" id="esProveedor" value="1">
                                            <label class="form-check-label" for="esProveedor">Proveedor</label>
                                        </div>
                                    </div>
                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" name="estado" id="estado">
                                                <option value="" disabled>Seleccione una opción</option>
                                                <option value="1" selected>Activo</option>
                                                <option value="0">Inactivo</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="btnRegistrar">Save changes</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END MODAL REGISTRAR EMPLEADO-->

<script src="views/assets/jspage/contacto.js"></script>