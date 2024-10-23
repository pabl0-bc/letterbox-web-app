<?php
require_once __DIR__ . '/../includes/config.php';
require_once BASE_APP . '/includes/SAs/UsuarioSA.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] == false || !isset($_SESSION['user_obj'])) {
    header("Location: index.php");
    exit();
}

if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['action'])){
    if ($_POST['action'] == 'follow') {
        $nombreUsuarioSeguir = $_POST['username'];
        $nombreUsuario = unserialize($_SESSION['user_obj'])->getNombreUsuario();
        // Call your PHP function based on the action
        $usuarioSA = new UsuarioSA();
        $usuarioSA->seguirUsuario($nombreUsuario, $nombreUsuarioSeguir);
    } else if ($_POST['action'] == 'unfollow') {
        $nombreUsuarioSeguir = $_POST['username'];
        $nombreUsuario = unserialize($_SESSION['user_obj'])->getNombreUsuario();
        // Call your PHP function based on the action
        $usuarioSA = new UsuarioSA();
        $usuarioSA->dejarDeSeguirUsuario($nombreUsuario, $nombreUsuarioSeguir);
    }
    
}

?>