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
            <button type="button" class="btn btn-primary heading-btn" onclick="newUsuario()">
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


