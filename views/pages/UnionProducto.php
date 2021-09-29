<?php 

$type = $_GET['type'];
$resultados = null;
switch ($type) {
    case 'marca':
        $resultados = ProductoController::getMarcas();
        break;

    case 'modelo':
        $resultados = ProductoController::getModelos();
        break;
    
    default:
        echo "<h1>Y para donde tu vas, tigueron!!</>";
        die;
        break;
}

// print_r($resultados);
// die;
?>

<div class="panel panel-flat">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="index.php?route=contacto"><i class="icon-home2 position-left"></i> Inicio</a></li>
            <li><a href="javascript:;"> <?php

                                        $titulo = '';

                                        if (!empty($_GET['type']) && isset($_GET['type']) && ($_GET['type'] === 'modelo' || $_GET['type'] === 'marca')) {
                                            $titulo = trim($_GET['type'] . "s");
                                        } else {
                                            $titulo = "Peligro";
                                        }
                                        echo ($titulo);
                                        ?>
                </a></li>
        </ul>
    </div>

    <div class="panel-heading">
        <h5 class="panel-title"><?php echo "ADMINISTRACION DE " . strtoupper($titulo) ?></h5>
        <div class="heading-elements">
            <button type="button" class="btn btn-primary heading-btn" id="btnRegistrar" data-toggle="modal" data-target="#registroContactoModal">
                <i class="icon-database-add"></i> AGREGAR NUEVO <?php echo strtoupper($titulo); ?></button>
        </div>
    </div>
</div>

<div id="reload-div">
    <table id="tbContacto" class="table datatable-basic table-xxs table-hover">
        <?php echo $resultados?>;
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