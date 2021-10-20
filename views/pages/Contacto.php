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
                <th>Direccion</th>
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
            $resultados = $contacto->getContactos($parametro);
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
                        <td> ' . $key["pais"] . ' </td>
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
                                <input type="hidden" name="idContacto" id="idContacto">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Razon Social</label>
                                            <input type="text" name="razonSocial" class="form-control" id="razonSocial" placeholder="Ingrese la razon social">
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
                                            <input type="text" name="identificacion" class="form-control" id="identificacion" placeholder="identificacion" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Pais</label>
                                            <select class="form-control" name="pais" id="pais">
                                                <option value="0" disabled selected>Seleccione un Pais</option>
                                                <?php
                                                    $pais = ConsultaController::getDatos("pais", "estado" , true);
                                                    foreach ($pais as $index => $key) {
                                                        echo "<option value=" . $key['idpais'] . " >" . $key['descripcion'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Provincia</label>
                                            <select class="form-control" name="provincia" id="provincia">
                                                <option value="" disabled>Seleccione una Provincia</option>
                                                <?php
                                                $provincia = ConsultaController::getDatos("provincia", "idpais" , 1);
                                                foreach ($provincia as $index => $key) {
                                                    echo "<option value=" . $key['idprovincia'] . " >" . $key['descripcion'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Direccion</label>
                                            <input type="text" name="correo" class="form-control" id="direccion" placeholder="direccion" required>
                                        </div>
                                    </div>
                        
                                    <!-- <hr Style='background-color: black'> -->
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Correo</label>
                                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo electronico" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="nombreModal">Telefono</label>
                                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Numero telefonico" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Referencia</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="esCliente" id="esCliente" value="1" <?php if ($_GET['type'] == "cliente") { echo "checked='checked'"; } ?> >
                                            <label class="form-check-label" for="esCliente">Cliente</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="esProveedor" id="esProveedor" value="1" <?php if ($_GET['type'] == "proveedor") { echo "checked='checked'"; } ?> >
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