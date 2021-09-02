<?php

class UsuarioController {
    static public function getUsuario() {
        $resultado = UsuarioModel::getUsuario();
        return $resultado;
    }
}