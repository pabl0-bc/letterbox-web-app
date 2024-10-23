<?php
require_once __DIR__ . '/../includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/DTOs/PeliculaDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/PeliculaSA.php'; // Asegúrate de que esta ruta sea correcta

// Obtiene el término de búsqueda del parámetro GET "query"
$query = isset($_GET['pelicula']) ? $_GET['pelicula'] : '';

if(isset($_GET['id_post'])){
    $id_post = $_GET['id_post'] ? $_GET['id_post'] : '';
    echo '<div id="id_post" data-id="' . $id_post . '"></div>'; // Imprimir el valor de $id_post como un atributo de datos
}
// Crea una instancia de UsuarioSA para buscar usuarios que coincidan con el término de búsqueda
$peliculaSA = new PeliculaSA();
$resultado = $peliculaSA->obtenerPeliculasSugeridas($query);

echo '<h5> Sugerencias: <h5>';
echo '<ul>';
foreach ($resultado as $pelicula) {
    echo '<li role="option" class="sugerencia-usuario">
    <img src="img/' . $pelicula->getCaratula() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 30px; height: 30px;">';
        echo '<a href="#" class="sugerencia-pelicula" data-query="' . $query . '" data-nombre="' . urlencode($pelicula->getNombre()) . '">' . $pelicula->getNombre() . '</a>
    </li>';
}
echo '</ul>';
?>

<script src="<?= RUTA_JS ?>/scripts.js"></script>