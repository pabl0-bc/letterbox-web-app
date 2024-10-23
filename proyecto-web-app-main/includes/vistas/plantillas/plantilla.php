<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?></title>
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
    require BASE_APP . '/includes/vistas/comun/cabecera.php';
    ?>
    <!-- Cabecera secundaria -->
	<?php if (isset($selectGenero)) : ?>
        <header class="cabecera_secundaria">
            <?= $selectGenero ?>
            <?= $indiceGenero ?>
        </header>
    <?php endif; ?>
    <?php if (isset($filtrado_blogs)) : ?>
        <header class="filtrado_blogs">
            <?= $filtrado_blogs ?>
        </header>
    <?php endif; ?>
        <?= $contenidoPrincipal ?>
    </div>
</body>
</html>
