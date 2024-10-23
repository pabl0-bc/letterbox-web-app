<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../Formularios/FormularioAgregarPeliculas.php';

$form = new FormularioAgregarPeliculas();
$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Agregar peliculas';

$contenidoPrincipal = <<<EOS
<div style="text-align:center;">
<h1>Agregar peliculas</h1>
</div>
$htmlFormRegistro
EOS;

require __DIR__ . '/../includes/vistas/plantillas/plantilla.php';
