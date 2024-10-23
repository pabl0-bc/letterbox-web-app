<?php
require_once __DIR__ . '/../includes/config.php';
require_once RAIZ_APP . '/session_start.php';
require_once RAIZ_APP . '/DTOs/UsuarioDTO.php'; // Asegúrate de que esta ruta sea correcta
require_once RAIZ_APP . '/SAs/UsuarioSA.php'; // Asegúrate de que esta ruta sea correcta

// Obtiene el término de búsqueda del parámetro GET "query"
$query = isset($_GET['usuario']) ? $_GET['usuario'] : '';
$id_post = isset($_GET['id_post']) ? $_GET['id_post'] : '';
// Crea una instancia de UsuarioSA para buscar usuarios que coincidan con el término de búsqueda
$usuarioSA = new UsuarioSA();
$resultado = $usuarioSA->buscarSugerido($query);

echo '<h5> Sugerencias: <h5>';
echo '<ul>';
foreach ($resultado as $usuario) {
    echo '<li role="option" class="sugerencia">
    <img src="img/' . $usuario->getProfileImage() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 30px; height: 30px;"> 
    <a href="#" class="sugerencia-usuario" data-query="' . $query . '" data-nombre="' . urlencode($usuario->getNombreUsuario()) . '">' . $usuario->getNombreUsuario() . '</a>      
    </li>';
}
echo '</ul>';
?>

<script src="<?= RUTA_JS ?>/scripts.js"></script>