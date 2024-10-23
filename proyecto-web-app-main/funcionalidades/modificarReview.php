<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../Formularios/FormularioModificarReview.php';

$form = new FormularioModificarReview($_GET['id']);


$htmlFormRegistro = $form->gestiona();
$tituloPagina = 'Modificar reviews';

$contenidoPrincipal = <<<EOS
<div style="text-align:center;">

<h1>Modificar reviews</h1>
</div>
$htmlFormRegistro
EOS;

require __DIR__ . '/../includes/vistas/plantillas/plantilla.php';
