<?php
    require_once RAIZ_APP . '/DTOs/UsuarioDTO.php';
function renderizarReviews($reviews_mostradas) {
    
    $html = '<div class="container">';
    foreach ($reviews_mostradas as $review) {
        $editar = '';
        $borrar = '';
        if (isset($_SESSION["user_obj"])) {
            if (unserialize($_SESSION["user_obj"])->getNombreUsuario() === $review->usuario) {
                $editar = '<a href="funcionalidades/modificarReview.php?id=' . $review->ID . '"><button class="btn btn-outline-success">Editar</button></a>';
            }
            if (unserialize($_SESSION["user_obj"])->getNombreUsuario() === $review->usuario ||
                unserialize($_SESSION["user_obj"])->getRole() == 1 ||
                unserialize($_SESSION["user_obj"])->getRole() == 2) {
                $borrar = '<a href="includes/borrarReview.php?id=' . $review->ID . '"><button class="btn btn-outline-danger">Borrar</button></a>';
            }
        }

        $html .= '
            <div class="review">
                <h2>' . $review->titulo . '</h2>
                <p><strong>Usuario:</strong> <a href="usuario.php?nombre=' . $review->usuario . '">' . $review->usuario . '</a></p>
                <p><strong>Critica:</strong> ' . $review->critica . '</p>
                <p><strong>Puntuación:</strong> ' . $review->puntuacion . '</p>
                <p><strong>Película:</strong> ' . $review->pelicula . '</p>
                ' . $editar . '
                ' . $borrar . '
            </div>';
    }
    $html . '</div>';
    return $html;
}

?>
