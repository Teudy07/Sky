<div class="panel panel-flat">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href=""><i class="icon-home2 position-left"></i> Inicio</a></li>
            <li><a href="javascript:;">Usuarios</a></li>
            <li class="active">Usuarios del Sistema</li>
        </ul>
    </div>

    <div class="panel-heading">
        <h5 class="panel-title">Usuarios del Sistema</h5>
        <div class="heading-elements">
            <button type="button" class="btn btn-primary heading-btn" data-toggle="modal" data-target="#registroUsuarioModal">
                <i class="icon-database-add"></i> Agregar Nuevo/a</button>
        </div>
    </div>
</div>

<div id="reload-div">
    <table class="table datatable-basic table-xxs table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Tipo de Usuario</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Sexo</th>
                <th>estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

        <?php 
            $usuario = new UsuarioController();
            $resultados = $usuario->getUsuario();

            foreach($resultados as $index => $key) {
                $indice = $index+1;
                $rol = '';
                // if($key["rol"] == 'administrador') {
                //     $rol = 'warning';
                // } else {
                //     $rol = 'warning';
                // }

                $rol  = ($key["rol"] == 'administrador') ? 'info' : 'primary';
                $estado  = ($key["estado"] == 1) ? '<span class="label label-success label-rounded">
                <span class="text-bold">ACTIVO</span>
                    </span>' : '<span class="label label-danger label-rounded">
                    <span class="text-bold">INACTIVO</span>';

                $indice = $index+1;
                echo '<tr>
                        <td> '.  $indice .' </td>
                        <td> 
                            <span class="label label-'. $rol  .' label-rounded">
                                <span class="text-bold">'. $key["rol"] .'</span>
                            </span>
                        </td>
                        <td> '. $key["usuario"] .' </td>
                        <td> '. $key["nombre"] .' ' .  $key["apellido"] .' </td>
                        <td> '. $key["sexo"] .' </td>
                        <td> '. $estado .' </td>

                        <td> 
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                            
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified">
                                                <i class="icon-pencil6">
                                                </i> Editar</a></li>
                                        <li><a href="javascript:;" data-toggle="modal" data-target="#modal_iconified">
                                                <i class=" icon-eye8">
                                                </i> Ver</a></li>
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
<div class="modal fade" id="registroUsuarioModal" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formRegistrarUsuario" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Registro de producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card hovercard">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="nombreModal" placeholder="Ingrese el nombre">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Apellido</label>
                                        <input type="text" name="apellido" class="form-control" id="apellidoModal" placeholder="Ingrese el apellido">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>identificacion</label>
                                        <select class="form-control select2bs4" name="identificacion" id="identificacionModel">
                                            <option value="" disabled selected>Seleccione una categoria</option>
                                            <?php 
                                                $sexo = ConsultaController::getDatos("tipo", "tipo","identificacion");
                                                foreach($sexo as $key) {
                                                    echo "<option value=". $key['idTipo'] .">" . $key['nombre'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select class="form-control select2bs4" name="identificacion" id="identificacionModel">
                                            <option value="" disabled selected>Seleccione una opcion</option>
                                            <?php 
                                                $sexo = ConsultaController::getDatos("sexo",null, null);
                                                foreach($sexo as $key) {
                                                    echo "<option value=". $key['idSexo'] .">" . $key['nombre'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Correo</label>
                                        <input type="email" name="correo" class="form-control" id="correoModal" placeholder="Correo electronico">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Telefono</label>
                                        <input type="text" name="telefono" class="form-control" id="telefonoModal" placeholder="Numero telefonico">
                                    </div>
                                </div>

                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <select class="form-control" name="rol" id="rolModal">
                                            <option value="" disabled selected>Seleccione una opcion</option>
                                            <?php 
                                                $sexo = ConsultaController::getDatos("rol",null, null);
                                                foreach($sexo as $key) {
                                                    echo "<option value=". $key['idRol'] .">" . $key['nombre'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Sub tipo</label>
                                        <select class="form-control select2bs4" name="idSubTipo" id="idSubTipo">
                                            <option value="" disabled selected>Seleccione subtipo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="producto" id="producto" placeholder="Ingrese el nombre del producto" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Descripcion</label>
                                        <div class="input-group mb-3">
                                            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Ingrese una descripcion del producto" cols="30" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="customFile">Custom File</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="imagenes" id="customFile" multiple>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" name="idEstado" id="idEstado">
                                            <option value="" disabled selected>Seleccione una opción</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
            </form>
          
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END MODAL REGISTRAR EMPLEADO-->