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
                                        <li><a href="javascript:;" class="editarUsuario" idusuario="'. $key["idUsuario"] .'" data-toggle="modal" data-target="#registroUsuarioModal">
                                                <i class="icon-pencil6 ">
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
                                <input type="hidden" name="idUsuario" id="idUsuario">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="apellido" placeholder="Ingrese el nombre" value="teudy" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Apellido</label>
                                        <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Ingrese el apellido" value="radames" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>identificacion</label>
                                        <select class="form-control select2bs4" name="tipoIdentificacion" id="tipoIdentificacion" required>
                                            <option value="" disabled selected>Seleccione una opcion</option>
                                            <?php 
                                                $sexo = ConsultaController::getDatos("tipo", "tipo","identificacion");
                                                foreach($sexo as $index => $key) {
                                                    echo "<option value=". $key['idtipo'] ." >" . $key['nombre'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Identificacion</label>
                                        <input type="text" name="identificacion" class="form-control" id="identificacion" placeholder="Ingrese el apellido" value="0310565465" required>
                                    </div>
                                </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Sexo</label>
                                        <select class="form-control select2bs4" name="sexo" id="sexo" required>
                                            <option value="" disabled selected>Seleccione una opcion</option>
                                            <?php 
                                                $sexo = ConsultaController::getDatos("sexo",null, null);
                                                foreach($sexo as $index => $key) {
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
                                        <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo electronico" value="teudy@sadf.com" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombreModal">Telefono</label>
                                        <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Numero telefonico" value="829-555-9999" required>
                                    </div>
                                </div>

                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Rol</label>
                                        <select class="form-control" name="rol" id="rolModal" required>
                                            <option value="" disabled selected>Seleccione una opcion</option>
                                            <?php 
                                                $sexo = ConsultaController::getDatos("rol",null, null);
                                                foreach($sexo as $index => $key) {
                                                        
                                                    echo "<option value=". $key['idRol'] .">" . $key['nombre'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                            <label for="nombreModal">usuario</label>
                                            <input type="text" name="usuario" class="form-control" id="usaurio" placeholder="Ingrese el nombre de usuario" value="teudy" required> 
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="clave" id="clave" placeholder="Ingrese la contraseña" autocomplete="off" value="123456" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6-lg col-xl-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Confirmar Contraseña</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" name="confirmarClave" id="confirmarClave" placeholder="Confirme la contraseña" autocomplete="off" value="123456" required>
                                        </div>
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save changes</button>
                </div>
                 <?php 
                    $usuario = UsuarioController::registrarUsuario();
                ?> 
            </form>
          
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- END MODAL REGISTRAR EMPLEADO-->

<script src="views/assets/jspage/usuario.js"></script>