<?php
require_once __DIR__ . '/SAs/PeliculaSA.php';
require_once __DIR__ . '/config.php';
require_once BASE_APP . '/includes/session_start.php';

$peliculaSA = new PeliculaSA();
$peliculaSA->borrarPelicula($_GET['id']);
header('Location: ../index.php');