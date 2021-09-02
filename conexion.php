<?php 
	$host = "127.0.0.1";   
	$basededatos = "sky";    
	$usuariodb = "root";    
	$clavedb = "24716323gg";
	
	$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);
	$selectDb = mysqli_select_db($conexion,$basededatos);

	if ($conexion->connect_errno) {
	    echo "Nuestro sitio experimenta fallos....";
	    exit();
	}
?>