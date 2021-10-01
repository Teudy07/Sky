<?php

$type = $_GET['type'];
$resultados = null;
$modalActivo = null;
switch ($type) {
    case 'marca':
        $resultados = ProductoController::getMarcas();
        $modalActivo = "ModalformularioMarca";
        break;

    case 'modelo':
        $resultados = ProductoController::getModelos();
        $modalActivo = "ModalformularioModelo";
        break;

    default:
        header("Location: index.php?route=404.php");
        die;
        break;
}

// print_r($resultados);
// die;
?>

<div class="panel panel-flat">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="index.php?route=UnionProducto"><i class="icon-home2 position-left"></i> Inicio</a></li>
            <li><a href="javascript:;"> <?php

                                        $titulo = '';

                                        if (!empty($_GET['type']) && isset($_GET['type']) && ($_GET['type'] === 'modelo' || $_GET['type'] === 'marca')) {
                                            $titulo = trim($_GET['type'] . "s");
                                        } else {
                                            $titulo = "Mantenimientos";
                                        }
                                        echo ($titulo);
                                        ?>
                </a></li>
        </ul>
    </div>

    <div class="panel-heading">
        <h5 class="panel-title"><?php echo "ADMINISTRACION DE " . strtoupper($titulo) ?></h5>
        <div class="heading-elements">
            <button type="button" class="btn btn-primary heading-btn" id="btnRegistrar" data-toggle="modal" data-target="<?php echo "#" . $modalActivo ?>">
                <i class="icon-database-add"></i> AGREGAR <?php echo strtoupper($titulo); ?></button>
        </div>
    </div>
</div>

<div id="reload-div">
    <table id="tbUnionProducto" class="table datatable-basic table-xxs table-hover">
        <?php echo $resultados ?>;
    </table>
</div>

<!-- MODAL REGISTRAR MODELOS-->
<div class="modal fade " id="ModalformularioModelo" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formularioModelo" class="formulario" method="post">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="titulo"><?php echo "MODELO " . $titulo ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="idModelo" id="idModelo" value="0">
                                <div class="row">

                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Marca</label>
                                            <select class="form-control" name="marca" id="marca" required>
                                                <option value="">Seleccione una opción</option>
                                                <!-- <option value="1" selected>Activo</option>
                                                <option value="0">Inactivo</option> -->
                                                <?php
                                                $sexo = ConsultaController::getDatos("marca", "estado", "1");
                                                foreach ($sexo as $index => $key) {
                                                    echo "<option value=" . $key['idmarca'] . ">" . $key['descripcion'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="nombreModal">MODELO</label>
                                            <input type="text" name="modelo" class="form-control" id="marca" placeholder="Ingrese el modelo" required>
                                        </div>
                                    </div>

                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" name="estado" id="estado" required>
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
                    <button type="submit" class="btn btn-info btnRegistrar" id="btnRegistrar">Save changes</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- MODAL REGISTRAR MARCAS-->
<div class="modal fade " id="ModalformularioMarca" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formularioMarca" class="formulario" method="post">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="titulo"><?php echo "MARCA " . $titulo ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="idMarca" id="idMarca" value="0"> 
                                <div class="row">

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nombreModal">Marca</label>
                                            <input type="text" name="marca" class="form-control" id="marca" placeholder="Ingrese el nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-6-lg col-xl-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control" name="estado" id="estado" required>
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
                    <button type="submit" class="btn btn-info btnRegistrar" id="btnRegistrar">Save changes</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END MODAL REGISTRAR EMPLEADO-->

<script src="views/assets/jspage/UnionProducto.js"></script>