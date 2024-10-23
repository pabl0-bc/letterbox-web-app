<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $tituloPagina ?>
  </title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?= RUTA_JS ?>/scripts.js"></script>



</head>

<body>
  <?php
  // Incluir la cabecera y el buscador
  require RAIZ_APP . '/vistas/comun/cabecera.php';

  // Definir $pagina con un valor predeterminado si no está definido
  $pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 0;
  $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
  $numElementos;

  $current_url = explode('?', $_SERVER['REQUEST_URI'])[0];

  $estrenos_url = RUTA_APP . '/estrenos.php';
  $reviews_url = RUTA_APP . '/lastReviews.php';
  $review_pelicula_url = RUTA_APP . '/reviewPelicula.php';
  $review_usuario_url = RUTA_APP . '/criticasUsuario.php';

  if ($current_url == $reviews_url) {
    $numElementos = ReviewDAO::obtenerTotalReviews();
    $numPaginas = ceil($numElementos / 5);
  } else if ($current_url == $estrenos_url) {
    $numElementos = PeliculaDAO::obtenerTotalPeliculas();
    $numPaginas = ceil($numElementos / 12);
  } else if ($current_url == $review_pelicula_url) {
    $numElementos = ReviewDAO::obtenerTotalReviewsPelicula($nombre);
    $numPaginas = ceil($numElementos / 5);
  } else if ($current_url == $review_usuario_url) {
    $numElementos = ReviewDAO::obtenerTotalReviewsUsuario(unserialize($_SESSION['user_obj'])->getNombreUsuario());
    $numPaginas = ceil($numElementos / 5);
  }
  ?>

  <!-- Cabecera secundaria -->
  <?php if (isset($selectGenero)): ?>
    <header class="cabecera_secundaria">
      <?= $selectGenero ?>
    </header>
  <?php endif; ?>

  <!-- Contenido principal -->
  <?= $contenidoPrincipal ?>

  <div id="pagination" class="d-flex justify-content-center align-items-center" style="pointer-events: none;">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li id="firstPage" class="page-item <?= $pagina > 0 ? '' : 'disabled' ?>" style="pointer-events: auto;">
                <a class="page-link" href="<?= $pagina > 0 ? $current_url . '?nombre=' . $nombre . '&pagina=0' : '#' ?>">Primera</a>
            </li>

            <li id="prevPage" class="page-item <?= $pagina > 0 ? '' : 'disabled' ?>" style="pointer-events: auto;">
                <a class="page-link" href="<?= $pagina > 0 ? $current_url . '?nombre=' . $nombre . '&pagina=' . ($pagina - 1) : '#' ?>">&laquo;</a>
            </li>

            <?php
            // Mostrar los enlaces de las páginas
            // Calcula el rango de páginas a mostrar
            $inicio = max(0, $pagina - 2); // Comienza como máximo desde la página 0
            $fin = min($numPaginas - 1, $pagina + 2); // Termina como máximo en la última página

            // Mostrar puntos suspensivos si es necesario
            if ($inicio > 0) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }

            // Generar enlaces de página
            for ($i = $inicio; $i <= $fin; $i++) {
                ?>
                <li class="page-item <?= $pagina == $i ? 'active' : '' ?>" style="pointer-events: auto;">
                    <a class="page-link" href="<?= $current_url ?>?nombre=<?= $nombre ?>&pagina=<?= $i ?>"><?= $i + 1 ?></a>
                </li>
                <?php
            }

            // Mostrar puntos suspensivos si es necesario
            if ($fin < $numPaginas - 1) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            ?>

            <li id="nextPage" class="page-item <?= $pagina < $numPaginas - 1 ? '' : 'disabled' ?>" style="pointer-events: auto;">
                <a class="page-link" href="<?= $pagina < $numPaginas - 1 ? $current_url . '?nombre=' . $nombre . '&pagina=' . ($pagina + 1) : '#' ?>">&raquo;</a>
            </li>

            <li id="lastPage" class="page-item <?= $pagina < $numPaginas - 1 ? '' : 'disabled' ?>" style="pointer-events: auto;">
                <a class="page-link" href="<?= $pagina < $numPaginas - 1 ? $current_url . '?nombre=' . $nombre . '&pagina=' . ($numPaginas - 1) : '#' ?>">Última</a>
            </li>
        </ul>
    </nav>
</div>


</body>

</html>