<?php
// buscar.php

// Incluir tus clases y configuraciones necesarias
require_once __DIR__ . '/../includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/DTOs/PeliculaDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/PeliculaSA.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/DTOs/UsuarioDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/UsuarioSA.php'; // Asegúrate de que esta ruta sea correcta

// Verificar si se ha proporcionado un término de búsqueda
if (isset($_GET['nombre'])) {
    $term = $_GET['nombre'];
    // Crear una instancia de PeliculaSA (probablemente usando algún tipo de inyección de dependencias o un contenedor)
    $peliculaSA = new PeliculaSA();
    $usuarioSA = new UsuarioSA();

    // Realizar la búsqueda de películas utilizando PeliculaSA
    $resultadosPelis = $peliculaSA->buscarPeliculasQueEmpecienPor($term);
    $resultadosUsuarios = $usuarioSA->buscarUsuariosQueEmpiecenPor($term);

    // Mostrar los resultados de las películas
    echo '<div class="row mt-5">';
    $numPelisAMostrar = min(4, count($resultadosPelis));
    for ($i = 0; $i < $numPelisAMostrar; $i++) {
        $pelicula = $resultadosPelis[$i];
        echo '<div class="col-md-3 mb-4">';
        echo '<a href="infoPeliculas.php?id=' . $pelicula->getId() . '">';
        echo '<img src="img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getCaratula() . '" class="img-fluid caratula">';
        echo '<p>' . $pelicula->getNombre() . '</p>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';

    // Mostrar los resultados de los usuarios
    echo '<div class="row mt-5">';
    $numUsuariosAMostrar = min(4, count($resultadosUsuarios));
    for ($i = 0; $i < $numUsuariosAMostrar; $i++) {
        $usuario = $resultadosUsuarios[$i];
        echo '<div class="col-md-3 mb-4">';
        echo '<a href="usuario.php?nombre=' . $usuario . '">';
        echo '<img src="img/' . ($usuarioSA->buscaUsuario($usuario))->getProfileImage() . '" alt="User Default Picture" class="img-fluid caratula">';
        echo '<p>' . $usuario . '</p>';
        echo '</a>';
        echo '</div>';
    }
    echo '</div>';
}
?>
