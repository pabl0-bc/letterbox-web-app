<?php
require ("includes/config.php");
require_once BASE_APP . '/includes/session_start.php';
require_once BASE_APP . '/includes/DTOs/UsuarioDTO.php';
require_once BASE_APP . '/includes/SAs/PeliculaSA.php';

$tituloPagina = 'FEELM - Home Page';
$contenidoPrincipal = '';

// Empieza a capturar el contenido principal
ob_start();
?>

<div id="carrusel" data-interval="3000" class="carousel slide" data-ride="carousel" style="background-color: black;">
    <!-- Indicadores (aparecen como rayitas) -->
    <ul class="carousel-indicators">
        <?php for ($i = 0; $i < 5; $i++): ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>">
            </li>
        <?php endfor; ?>
    </ul>
    <!-- Diapositivas (elementos del carrusel) -->
    <div class="carousel-inner">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <div class="carousel-item <?= $i === 1 ? 'active' : '' ?>">
                <img src="img/carrusel<?= $i ?>.png" class="img-fluid" alt="Carrusel <?= $i ?>">
            </div>
        <?php endfor; ?>
    </div>
    <!-- Controles para pasar a la anterior o a la siguiente -->
    <a class="carousel-control-prev" href="#carrusel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carrusel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>
<div class="text-center" style="background-color: black; padding-top: 1vh;">
    <a href="#scroll-target" class="arrow-down">
        <span class="material-icons" style="font-size: 48px;">arrow_downward</span>
    </a>
</div>

<!-- Contenido después del Carrusel -->
<div id="scroll-target" class="container-fluid" style="min-height: 110vh; padding-top: 35vh; background-color: black;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="mb-4 text-light">¡Únete ya a esta gran comunidad y comparte tus gustos!</h1>
                <p class="lead text-light">En FEELM, puedes compartir tus opiniones sobre tus películas
                    favoritas,
                    conocer personas afines a ti y mucho más.</p>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-4 text-center">
                <button class="btn btn-secondary btn-lg btn-block" onclick="location.href='login.php';">Iniciar
                    sesión</button>
            </div>
            <div class="col-lg-4 text-center mt-2 mt-lg-0">
                <button class="btn btn-light btn-lg btn-block"
                    onclick="location.href='registro.php';">Registrarse</button>
            </div>
        </div>
        <div class="text-center" style="margin-top: 10vh;">
            <a href="#" class="arrow-up">
                <span class="material-icons" style="font-size: 48px;">arrow_upward</span>
            </a>
        </div>
    </div>
</div>


<script>
    
</script>

<?php
// Finaliza la captura del contenido principal
$contenidoPrincipal = ob_get_clean();

// Incluir la plantilla al final para que se muestre correctamente
require BASE_APP . '/includes/vistas/plantillas/plantilla.php';
?>
