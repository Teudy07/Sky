<?php


//nota = nombre tabla + campo + valor
class ConsultaController {
    static public function getDatos($table, $item, $value) {
        $resultado = ConsultaModel::getDatos($table, $item, $value);
        return $resultado;
    }
}
