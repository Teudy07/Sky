<?php
$vars = get_defined_vars();  
print_r($vars); 
session_start();

$email=$_POST["email"];
$pass=$_POST["password"];


include("conexion.php");
$resultados = mysqli_query($conexion,"SELECT * FROM usuario_v WHERE usuario = '$email'");
$consulta = mysqli_fetch_array($resultados);

if($consulta==true)
{ 
    $correo=$consulta['usuario'];
    $contra=$consulta['clave'];

    if($correo==$email and $contra==$pass)
    {
        $_SESSION['user']=$correo;
        $_SESSION['idUsuario']=$consulta['idUsuario'];;
        setcookie("usuario", $email, time()+(60*60*24*365));
        header ("Location: index.php?route=home");
    }
    else{

        header ("Location: login.php?r");
    }
}
else
{
    header ("Location: login.php?r");

}

include("conexionoff.php");?>
