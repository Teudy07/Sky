<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Usuarios</title>

	<?php 
 include("header.php") 
  ?>

</head>

<body class="has-detached-right  pace-done">
	<div class="pace  pace-inactive">
		<div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%"
			data-progress="99">
			<div class="pace-progress-inner"></div>
		</div>
		<div class="pace-activity"></div>
	</div>

	<!-- Main navbar -->
	<div class="navbar navbar-dark">
		<div class="navbar-header">
			<a class="navbar-header" href=""><img src="" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-lock2"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
				</li>
			</ul>

			<p class="navbar-text"><span class="label bg-success">Online</span></p>

			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php"><i class="icon-switch2"></i> LOGOUT</a></li>
			</ul>
			</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container" style="min-height:876.3000030517578px">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">
					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">

								<div class="media-body">
									<span class="media-heading text-semibold"> Usuario</span>
									<div class="text-size-mini text-muted">
										pendiente </div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<li class="active"><a href="home.php"><i class="icon-home4"></i> <span>Home</span></a>
								</li>

								<!-- Almacen -->
								<li>
									<a href="#" class="has-ul"><i class="icon-box"></i> <span>Almacen</span></a>
									<ul class="hidden-ul">
										<li><a href="">Categoria</a></li>
										<li><a href="">Marca</a></li>
										<li><a href="mantenimientos.php">Producto</a></li>
									</ul>
								</li>
								<!-- /Almacen -->

								<!-- Cotizaciones -->
								<li>
									<a href="#" class="has-ul"><i class="icon-file-spreadsheet"></i>
										<span>Cotizaciones</span></a>
									<ul class="hidden-ul">
										<li><a href="">Generar Cotizacion</a></li>
										<li><a href="">Ver Cotizaciones</a></li>
									</ul>
								</li>
								<!-- /Cotizaciones -->


								<!-- Compras -->
								<li>
									<a href="#" class="has-ul"><i class="icon-truck"></i> <span>Compras</span></a>
									<ul class="hidden-ul">
										<li><a href="">Realizar Compras</a></li>
										<li><a href="">Proveedores</a></li>
										<li><a href="">Consultar Compras por Fecha</a></li>
									</ul>
								</li>

								<!-- Compras a Credito -->
								<li>
									<a href="#" class="has-ul"><i class="icon-coins"></i> <span>Compras a
											Credito</span></a>
									<ul class="hidden-ul">
										<li><a href="">Administrar Creditos</a></li>
									</ul>
								</li>
								<!-- /Compras -->

								<!-- Ventas -->
								<li>
									<a href="#" class="has-ul"><i class="icon-cart"></i> <span>Ventas</span></a>
									<ul class="hidden-ul">
										<li><a href="./?View=Clientes">Clientes</a></li>
										<li><a href="">Realizar Ventas</a></li>
										<li><a href="">Consultar Ventas del Dia</a></li>
										<li><a href="a">Consultar Ventas por Fecha</a></li>
									</ul>
								</li>
								<!-- /Ventas -->

								<!-- Creditos -->
								<li>
									<a href="#" class="has-ul"><i class="icon-coins"></i> <span>Ventas a
											Credito</span></a>
									<ul class="hidden-ul">
										<li><a href="">Administrar Creditos</a></li>
									</ul>
								</li>
								<!-- /Creditos -->

								<!-- Taller  --->
								<li>
									<a href="#" class="has-ul"><i class="icon-hammer-wrench"></i>
										<span>Taller</span></a>
									<ul class="hidden-ul">
										<li><a href="">Orden de Taller</a></li>
										<li><a href="">Tecnicos</a></li>
									</ul>
								</li>
								<!-- Taller --->

								<!-- Documentos -->
								<li>
									<a href="#" class="has-ul"><i
											class="icon-certificate"></i><span>Comprobantes</span></a>
									<ul class="hidden-ul">
										<li><a href="">Tipo de Comprobante</a></li>
										<li><a href="">Gestion de Comprobantes</a></li>
									</ul>
								</li>
								<!-- /Documentos -->



								<!-- Usuarios -->
								<li>
									<a href="#" class="has-ul"><i class="icon-users"></i> <span>Usuarios</span></a>
									<ul class="hidden-ul">
										<li><a href="">Empleados</a></li>
										<li><a href="">Usuario</a></li>

									</ul>
								</li>
								<!-- /Usuarios -->

								<!-- /Acera de -->
								<li>
									<a href=""><i class="icon-info22"></i> <span> Acerca de </span></a>
								</li>
								<!--Acerca de  -->
							</ul>
						</div>
					</div>

					<br>
					<br>
					<br>
					<!-- Footer -->
					<div class="footer text-muted">
						© 2020 <a href="">Sky</a>
					</div>
					<!-- /footer -->
					<!-- /main navigation -->
				</div>
			</div>
			<!-- /main sidebar -->

			<!-- Main content para los Boxes-->
			<div class="content-wrapper">
				<!-- Content area -->
				<div class="content">

					<!-- Borrar-->
					<!-- Basic initialization -->
					<div class="panel panel-flat">
						<div class="breadcrumb-line">
							<ul class="breadcrumb">
								<li><a href="
						"><i class="icon-home2 position-left"></i> Inicio</a></li>
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
						<div class="panel-body">
						</div>
						<div id="reload-div">
							<table class="table datatable-basic table-xxs table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Usuario</th>
										<th>Tipo de Usuario</th>
										<th>Empleado</th>
										<th>Estado</th>
										<th class="text-center">Opciones</th>
									</tr>
								</thead>

								<tbody>

									<tr>
										<td>1</td>
										<td>admin</td>
										<td><span class="label label-warning label-rounded"><span
													class="text-bold">ADMINISTRADOR</span></span></td>
										<td>JUAN CARLOS BARRA</td>
										<td><span class="label label-success label-rounded"><span
													class="text-bold">ACTIVO</span></span></td>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="javascript:;" data-toggle="modal"
																data-target="#modal_iconified" onclick="openUsuario('editar',
								                     '1',
								                     'admin',
								                     'admin',
								                     '1',
								                     '1',
								                     '1')">
																<i class="icon-pencil6">
																</i> Editar</a></li>
														<li><a href="javascript:;" data-toggle="modal"
																data-target="#modal_iconified" onclick="openUsuario('ver',
								                     '1',
								                     'admin',
								                     'admin',
								                     '1',
								                     '1',
								                     '1')">
																<i class=" icon-eye8">
																</i> Ver</a></li>
													</ul>
												</li>
											</ul>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>cajero</td>
										<td><span class="label label-info label-rounded">
												<span class="text-bold">CAJA</span></span></td>
										<td>HENRRY SANTOS</td>
										<td><span class="label label-success label-rounded"><span
													class="text-bold">ACTIVO</span></span></td>
										<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="javascript:;" data-toggle="modal"
																data-target="#modal_iconified" onclick="openUsuario('editar',
								                     '2',
								                     'cajero',
								                     '123456',
								                     '2',
								                     '1',
								                     '11')">
																<i class="icon-pencil6">
																</i> Editar</a></li>
														<li><a href="javascript:;" data-toggle="modal"
																data-target="#modal_iconified" onclick="openUsuario('ver',
								                     '2',
								                     'cajero',
								                     '123456',
								                     '2',
								                     '1',
								                     '11')">
																<i class=" icon-eye8">
																</i> Ver</a></li>
													</ul>
												</li>
											</ul>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>

					<!-- Iconified modal -->
					<div id="modal_iconified" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title"><i class="icon-pencil7"></i> &nbsp; <span
											class="title-form"></span></h5>
								</div>

								<form role="form" autocomplete="off" class="form-validate-jquery" id="frmModal">
									<div class="modal-body" id="modal-container">

										<div class="alert alert-info alert-styled-left text-blue-800 content-group">
											<span class="text-semibold">Estimado usuario</span>
											Los campos remarcados con <span class="text-danger"> * </span> son
											necesarios.
											<button type="button" class="close" data-dismiss="alert">×</button>
											<input type="hidden" id="txtID" name="txtID" class="form-control" value="">
											<input type="hidden" id="txtProceso" name="txtProceso" class="form-control"
												value="">
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-sm-12">
													<label>Empleado <span class="text-danger">*</span></label>
													<select data-placeholder="..." id="cbEmpleado" name="cbEmpleado"
														class="select-search" style="text-transform:uppercase;"
														onkeyup="javascript:this.value=this.value.toUpperCase();">
														<option value="1">
															JUAN CARLOS BARRA </option>
														<option value="4">
															DELMAR QUIJADA </option>
														<option value="5">
															WILSON FERNANDEZ </option>
														<option value="6">
															PEPE PEPE </option>
														<option value="7">
															ROY CARLOS HUAYRE </option>
														<option value="8">
															ALBERTO LOPEZ </option>
														<option value="9">
															WILMAN AGUILAR </option>
														<option value="10">
															DIEGO ARMANDO CARRENO </option>
														<option value="11">
															HENRRY SANTOS </option>
													</select>
												</div>
											</div>
										</div>


										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label>Usuario <span class="text-danger">*</span></label>
													<input type="text" id="txtUser" name="txtUser"
														placeholder="EJ. ABEL20" class="form-control">
												</div>

												<div class="col-sm-6">
													<label>Password <span class="text-danger">*</span></label>
													<input type="password" id="txtPassword" name="txtPassword"
														class="form-control"
														placeholder="ESCRIBA EL PASSWORD DEL USUARIO">
												</div>

											</div>
										</div>


										<div class="form-group">
											<div class="row">
												<div class="col-sm-6">
													<label>Tipo Usuario <span class="text-danger">*</span></label>
													<select data-placeholder="..." id="cbTipo" name="cbTipo"
														class="select-search" style="text-transform:uppercase;"
														onkeyup="javascript:this.value=this.value.toUpperCase();">
														<option value="1">ADMINISTRADOR</option>
														<option value="2">CAJERO/A</option>
													</select>
												</div>
											</div>
										</div>


										<div class="form-group">
											<div class="row">
												<div class="col-sm-8">
													<div class="checkbox checkbox-switchery switchery-sm">
														<label>
															<input type="checkbox" id="chkEstado" name="chkEstado"
																class="switchery" checked="checked">
															<span id="lblchk">VIGENTE</span>
														</label>
													</div>
												</div>
											</div>
										</div>


									</div>

									<div class="modal-footer">
										<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>
										<button id="btnEditar" type="submit" class="btn btn-warning">Editar</button>
										<button type="reset" class="btn btn-default" id="reset" class="btn btn-link"
											data-dismiss="modal">Cerrar</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /iconified modal -->
					<!-- borrar-->


				</div>
			</div>
			<!-- /content area -->
		</div>

		<!-- /main content -->

	</div>
	<!-- /page content -->

	</div>
	<!-- /page container -->

</body>

</html>