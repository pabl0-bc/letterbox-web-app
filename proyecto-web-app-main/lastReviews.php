<?php
require_once __DIR__ . '/includes/config.php';
require_once BASE_APP . '/includes/session_start.php';
require_once __DIR__ . '/includes/SAs/PeliculaSA.php';
require_once __DIR__ . '/includes/SAs/reviewSA.php';
require_once __DIR__ . '/includes/vistas/plantillas/reviewsPlantilla.php'; // Incluir la plantilla de reviews
require_once BASE_APP . '/includes/DTOs/UsuarioDTO.php';

$tituloPagina = 'Últimas reviews';

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 0;
$paginaActual = $pagina;// Usar el operador de fusión de null para proporcionar un valor predeterminado
$reviewSA = new ReviewSA();
$reviews = $reviewSA->obtener5Reviews($paginaActual * 5);

$totalElementos = $reviewSA->obtenerTotalReviews();
// Mostrar las primeras 5 revisiones
$num_reviews_mostrar = 5;
$reviews_mostradas = array_slice($reviews, 0, $num_reviews_mostrar);

$contenidoPrincipal = '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeras 5 Revisiones</title>
</head>
<body>
    <h1>Últimas reviews</h1>';

$contenidoPrincipal .= '
<form id="searchForm" class="form-inline my-2 my-lg-0" action="/proyecto-web-app/funcionalidades/agregarReseña.php" method="get"
        <div style="position: absolute; right: 8vh;">
            <div class="d-flex flex-column align-items-center">
                <div class="mb-3">
                    <input type="text" name="nombre" class="form-control w-100" id="searchReview" placeholder="Buscar película..."  autocomplete="off">
                <div id="sugerencias" class="w-100"></div>
                </div>
                <div class="list-group position-absolute" id="reviewList"></div>
            </div>
        </div>
</form>
';

$contenidoPrincipal .= '<div style="height: 6vh;"></div>';

$contenidoPrincipal .= renderizarReviews($reviews_mostradas); // Renderizar las reviews usando la plantilla

$contenidoPrincipal .= '


</body>
</html>';


function buscarPeliculaPorNombre($nombre) {
    $peliculaSA = new PeliculaSA();
    $pelicula = $peliculaSA->obtenerPeliculaPorNombre($nombre);
    return $pelicula;
}



require BASE_APP . '/includes/vistas/plantillas/plantillaPaginacion.php';
