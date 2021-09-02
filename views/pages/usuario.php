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



<?php 
    $usuario = new UsuarioController();
    echo "<pre>";
    print_r($usuario->getUsuario());
    echo "</pre>";

?>