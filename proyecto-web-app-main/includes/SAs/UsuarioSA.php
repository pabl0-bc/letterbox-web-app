<?php

require_once __DIR__ . '/../DAOs/UsuarioDAO.php';
require_once __DIR__ . '/../DTOs/UsuarioDTO.php';

class UsuarioSA {

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 0;

    public const MOD_ROLE = 2;

    public function __construct() {
        
    }

    public function login($nombreUsuario, $password) {
        $usuario = UsuarioDAO::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    public function crea($nombreUsuario, $password, $email, $role, $profile_image) {
        $user = UsuarioDAO::crea($nombreUsuario, $password, $email, $role, $profile_image);
        if (!$user) {
            echo "Error creating user";
        }     
        return $user;

    }

    public function actualizaUsuario(UsuarioDTO $usuario) {
        return UsuarioDAO::actualizaUsuario($usuario);
    }

    public function buscaUsuario($nombreUsuario) {
        return UsuarioDAO::buscaUsuario($nombreUsuario);
    }

    public function buscaPorId($idUsuario) {
        return UsuarioDAO::buscaPorId($idUsuario);
    }

    public function borra(UsuarioDTO $usuario) {
        return UsuarioDAO::borra($usuario);
    }

    public function borraPorId($idUsuario) {
        return UsuarioDAO::borraPorId($idUsuario);
    }

    public function seguirUsuario($nombreUsuario, $nombreUsuarioSeguir) {
        return UsuarioDAO::seguirUsuario($nombreUsuario, $nombreUsuarioSeguir);
    }

    public function dejarDeSeguirUsuario($nombreUsuario, $nombreUsuarioSeguir) {
        return UsuarioDAO::dejarDeSeguirUsuario($nombreUsuario, $nombreUsuarioSeguir);
    }

    public function buscarUsuariosQueEmpiecenPor($term) {
        return UsuarioDAO::buscarUsuariosQueEmpiecenPor($term);
    }

    public function buscaNombrePorId($idUsuario) {
        return UsuarioDAO::buscaNombrePorId($idUsuario);
    }

    public function buscarSugerido($term) {
        return UsuarioDAO::buscarSugerido($term);
    }

    public function promoverUsuario($idUsuario){
return UsuarioDAO::promoverUsuario($idUsuario);
    }

    public function degradarUsuario($idUsuario){
return UsuarioDAO::degradarUsuario($idUsuario);
    }

    public function buscarEmail($email){
        return UsuarioDAO::buscarEmail($email);
    }
}

