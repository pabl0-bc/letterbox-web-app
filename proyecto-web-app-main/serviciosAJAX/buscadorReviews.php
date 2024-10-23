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

    // Realizar la búsqueda de películas utilizando PeliculaSA
    $resultadosPelis = $peliculaSA->buscarPeliculasQueEmpecienPor($term);

    // Mostrar los resultados de las películas
    $htmlList = '<ul class="list-group" style="max-height: 40vh; overflow-y: auto">';
    foreach ($resultadosPelis as $pelicula) {
        $htmlList .= '<li class="list-group-item">
                        <img src="/proyecto-web-app/img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getCaratula() . '" class="rounded-circle mr-2" style="width: 10vh; height: 10vh;">
                        <a href="/proyecto-web-app/funcionalidades/agregarReseña.php?id=' . $pelicula->getId() . '">' . $pelicula->getNombre() . '</a>
                    </li>';    
    }
    $htmlList .= '</ul>';
    
    echo $htmlList;
}