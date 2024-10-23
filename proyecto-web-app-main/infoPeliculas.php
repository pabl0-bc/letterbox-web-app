<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/DTOs/UsuarioDTO.php';

// Crear una instancia de la clase PeliculaSA
$peliculaSA = new PeliculaSA();

// Verificar si se ha proporcionado un ID de película en la URL
$contenidoPrincipal = '';

if (isset ($_GET['id']) || isset ($_GET['nombre'])) {
    // Obtener el ID de la película de la URL
    // Obtener la información de la película
    if(isset($_GET['id'])) {
        $idPelicula = $_GET['id'];
        $pelicula = $peliculaSA->obtenerPeliculaPorId($idPelicula);
    } else {
        $pelicula = $peliculaSA->obtenerPeliculaPorNombre($_GET['nombre']);
    }

    $peliculaSA->realizarMedia($pelicula);

    // Verificar si el usuario tiene permisos para borrar o modificar la película
    if (isset ($_SESSION["user_obj"]) && unserialize($_SESSION["user_obj"])->getRole() == 1) {
        $contenidoPrincipal .= '
        <div class="container text-center mb-4">
            <a href="includes/borrarPelicula.php?id=' . $pelicula->getId() . '"><button class="btn btn-danger">Borrar Película</button></a>
            <a href="funcionalidades/modificarPelicula.php?id=' . $pelicula->getId() . '"><button class="btn btn-primary ml-2">Modificar</button></a>
        </div>
        ';
    }

    // Generar el contenido principal con la información de la película
    $contenidoPrincipal .= '
    <div class="container">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <img src="img/' . $pelicula->getCaratula() . '" alt="' . $pelicula->getNombre() . '" class="img-fluid caratula-img">
            </div>
            <div class="col-md-8">
                <h1>' . $pelicula->getNombre() . '</h1>
                <p><strong>Director:</strong> ' . $pelicula->getDirector() . '</p>
                <p><strong>Género:</strong> ' . $pelicula->getGenero() . '</p>
                <p><strong>Descripción:</strong> ' . $pelicula->getDescripcion() . '</p>
                <p><strong>Valoración:</strong> ' . $pelicula->getValoracion() . '</p>
                <div class="embed-responsive embed-responsive-16by9" style="max-width: 560px; max-height: 315px;">
                    <iframe class="embed-responsive-item" src="' . $pelicula->getTrailer() . '" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center mt-4">
        <div class="rating-container">
            <p><strong>Valoración:</strong></p>
            <div class="rating-stars">';
    // Obtener la valoración de la película
    $valoracion = $pelicula->getValoracion();
    // Redondear la valoración al número entero más cercano
    $valoracionRedondeada = round($valoracion);
    // Mostrar la valoración en forma de estrellas
    for ($i = 1; $i <= 5; $i++) {
        // Si la posición actual es menor o igual que la valoración redondeada, muestra una estrella completa
        if ($i <= $valoracionRedondeada) {
            $contenidoPrincipal .= '<span>&#9733;</span>';
        } else {
            // De lo contrario, muestra una estrella vacía
            $contenidoPrincipal .= '<span>&#9734;</span>';
        }
    }
    $contenidoPrincipal .= '</div>
        </div>
        
        <div class="row justify-content-center mt-4">';
        if(isset($_SESSION["user_obj"]) != null) {
            $contenidoPrincipal .='
            <div class="col-md-4">
                <a href="funcionalidades/agregarReseña.php?id=' . $pelicula->getId() . '" class="btn btn-success btn-block">Realizar review</a>
            </div>';
        }
        $contenidoPrincipal .='
            <div class="col-md-4">
                <a href="reviewPelicula.php?nombre=' . urlencode($pelicula->getNombre()) . '" class="btn btn-primary btn-block">Ver Reviews</a>
            </div>
        </div>
    </div>';
} else {
    // Si no se proporciona un ID de película en la URL, muestra un mensaje de error o redirecciona a otra página, según lo que necesites.
    echo '<p>Error: No se proporcionó un ID de película.</p>';
}

// Incluir la plantilla principal para mostrar el contenido
require BASE_APP . '/includes/vistas/plantillas/plantilla.php';