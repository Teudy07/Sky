<?php

class Conexion {
    static public function conecion() {
        $link = new PDO("mysql:host=localhost;dbname=sky", "root","24716323gg");
        $link->exec("set names utf8");
        return $link;
    }
}