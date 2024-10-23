<?php
require_once __DIR__ . '/../includes/config.php';
require_once BASE_APP . '/includes/SAs/UsuarioSA.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] == false || !isset($_SESSION['user_obj'])) {
    header('Location: ' . BASE_APP . 'login.php');
    exit();
}

if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
    $nombreUsuario = htmlspecialchars($_POST['username']);
    $usuarioSA = new UsuarioSA();
    $usuario = $usuarioSA->buscaUsuario($nombreUsuario);
    if ($usuario->compruebaPassword($_POST['password'])) {
        if(isset($_POST['new_username']) && !empty($_POST['new_username']) && (!$usuarioSA->buscaUsuario($_POST['new_username']) || $_POST['new_username'] == unserialize($_SESSION['user_obj'])->getNombreUsuario())) {

            $usuario->setNombreUsuario(htmlspecialchars($_POST['new_username']));
        }
        else{
            echo "usuario ya existente";
        }
        if(isset($_POST['new_email']) && !empty($_POST['new_email'] && (!$usuarioSA->buscarEmail($_POST['new_email']) || $_POST['new_email'] == unserialize($_SESSION['user_obj'])->getEmail()))) {
            $usuario->setEmail(htmlspecialchars(htmlspecialchars($_POST['new_email'])));
        }
        else{
            echo "correo ya existente";
        }
        if(isset($_POST['new_password']) && !empty($_POST['new_password'])){
            $usuario->cambiaPassword($_POST['new_password']);
        }
        if (isset($_FILES['new_profile_image']) && $_FILES['new_profile_image']['error'] == 0) {
            $targetDir = __DIR__ . '/../img/';
            $fileType = strtolower(pathinfo($_FILES['new_profile_image']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . $nombreUsuario . "." . $fileType;
            $allowedTypes = array('png', 'jpg', 'jpeg', 'gif');
            $maxFileSize = 5 * 1024 * 1024; // 5MB

            if (!in_array($fileType, $allowedTypes)) {
                return 'El tipo de archivo no es válido';
            } elseif ($_FILES['new_profile_image']['size'] > $maxFileSize) {
                return 'El tamaño del archivo supera el límite permitido (5MB)';
            } elseif (move_uploaded_file($_FILES['new_profile_image']['tmp_name'], $targetFile)) {
                $new_profile_image = $nombreUsuario . "." . $fileType;
                $usuario->setProfileImage($new_profile_image);
            } else {
                return 'Error al subir la imagen';
            }
        }
        $usuarioSA->actualizaUsuario($usuario);
        $_SESSION['user_obj'] = serialize($usuario);
    } else {
        echo "La contraseña no es correcta";
    }
} else {
    echo "No se han rellenado todos los campos";
}

?>