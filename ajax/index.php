<?php

$controlador = trim( $_GET['c']);

require_once "../controllers/".$controlador."Controller.php";
require_once "../models/".$controlador."Model.php";
$controlador = trim( $_GET['c']) . "Controller";

$metodo = $_GET['m'];
$instancia = $controlador::$metodo();
