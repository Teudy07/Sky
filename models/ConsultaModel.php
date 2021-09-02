<?php 

require_once "Conexion.php";

class ConsultaModel {

    static public function getDatos($table, $item, $value) {
        $data = null;
        if($item != null) {
            $data = Conexion::conecion()->prepare("SELECT * FROM $table WHERE $item = :$item");
            $data ->bindParam(":".$item, $value, PDO::PARAM_STR);
            $data->execute();
            return $data -> fetchAll();
        } else {
            $data = Conexion::conecion()->prepare("SELECT * FROM $table");
            $data->execute();
            return $data -> fetchAll();
        }
    }
}