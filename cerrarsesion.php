<?php 
  if(isset($_COOKIE["usuario"])) { 
    setcookie("usuario", '', time() - 42000); 
  } 
  header("Location: login.php");
?> 