<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar con desplegable</title>
</head>

<body>

    <?php
    require_once __DIR__ . '/../../config.php';
    require_once RAIZ_APP . '/session_start.php';
    require_once RAIZ_APP . '/DTOs/UsuarioDTO.php';
    require_once RAIZ_APP . '/SAs/PeliculaSA.php';

    $current_url = $_SERVER['REQUEST_URI'];

    $estrenos_url = RUTA_APP . '/estrenos.php';
    $reviews_url = RUTA_APP . '/lastReviews.php';
    $blog_url = RUTA_APP . '/Blog.php';
    $ranking_url = RUTA_APP . '/ranking.php';
    $search_url = RUTA_APP . '/includes/vistas/comun/buscador.php';
    $agregar_pelicula_url = RUTA_APP . '/funcionalidades/agregarPelicula.php';
    $logout_url = RUTA_APP . '/includes/logout.php';
    $login_url = RUTA_APP . '/login.php';

    $estrenos_active = ($current_url == $estrenos_url) ? 'active' : '';
    $reviews_active = ($current_url == $reviews_url) ? 'active' : '';
    $blog_active = ($current_url == $blog_url) ? 'active' : '';
    $ranking_active = ($current_url == $ranking_url) ? 'active' : '';

    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="<?= RUTA_APP ?>/index.php">
            <img src="<?= RUTA_IMGS ?>/logo.png" alt="Logo" class="img-fluid" style="max-height: 40px;">
        </a>
        <a class="git-brand" href="https://github.com/AlainMgz/proyecto-web-app?files=1">
            <img src="<?= RUTA_IMGS ?>/git.png" alt="Logo" class="img-fluid" style="max-height: 40px;">
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $estrenos_active ?>">
                    <a href="<?= $estrenos_url ?>" class="nav-link">Estrenos</a>
                </li>
                <li class="nav-item <?= $reviews_active ?>">
                    <a href="<?= $reviews_url ?>" class="nav-link">Reviews</a>
                </li>
                <li class="nav-item <?= $blog_active ?>">
                    <a href="<?= $blog_url ?>" class="nav-link">Blog</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form id="searchForm" class="form-inline my-2 my-lg-0" action="/proyecto-web-app/infoPeliculas.php" method="get"
                        autocomplete="off">
                        <input class="form-control mr-sm-2" id="searchInput" type="search" name="nombre"
                            placeholder="Buscar">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </li>
                <li class="nav-item">
                    <?php if (!isset($_SESSION["login"]) || $_SESSION["login"] === false): ?>
                    <li class="nav-item"><a href="<?= $login_url ?>" class="nav-link">Unknown user. Login</a></li>
                    <?php else:
                        $username = unserialize($_SESSION['user_obj'])->getNombreUsuario(); ?>
                    <ul class="navbar-nav mr-auto ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hello <?= $username ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="criticasUsuario.php">Tus críticas</a>
                                <a class="dropdown-item" href="usuario.php?nombre=<?= $username ?>">Perfil</a>
                                <a class="dropdown-item" href="<?= $logout_url ?>">Logout</a>
                            </div>
                        </li>
                    </ul>
                    <?php endif; ?>

                </li>
            </ul>
        </div>

    </nav>

    <div class="search-overlay" id="searchOverlay">
        <div class="search-container">
            <h4>Resultados para: <span id="searchQuery"></span></h4>
            <div id="searchResults"></div> <!-- Aquí se mostrarán los resultados de búsqueda -->
            <button id="closeSearch">Cerrar</button>
        </div>
    </div>

</body>

</html>