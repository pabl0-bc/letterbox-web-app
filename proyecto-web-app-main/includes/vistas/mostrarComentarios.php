<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../SAs/postSA.php';

class mostrarComentarios {
    public function __construct() {}

    public function construirComentarios($postId, $usuario) {
        $postSA = new postSA();
        $comments = $postSA->buscarComentarios($postId);

        $contenidoComments = '';

        foreach ($comments as $comment) {
            $usuarioSA = new UsuarioSA();
            $usuarioComent = $usuarioSA->buscaPorId($comment->getIDusuario());

            $contenidoComments .= '
                <li class="list-group-item">
                    <div class="card-body">
                        <div class="media px-2 pt-3">
                            <img src="img/' . $usuarioComent->getProfileImage() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                            <div class="media-body">
                                <h5 class="mt-0">@<a href="usuario.php?nombre=' . urlencode($usuarioComent->getNombreUsuario()) . '">' . escape($usuarioComent->getNombreUsuario()) . ($usuarioComent->getRole() == 2 ? '<i class="fas fa-check-circle text-primary"></i>' : ($usuarioComent->getRole() == 1 ? '<i class="fas fa-check-circle text-warning"></i>' : '')) . '</a></h5>
                            </div>
                        </div>';
                        $texto_post = $comment->getContenido();

                        $texto_post_con_enlaces = preg_replace_callback('/@(\w[\w.-]*)/', function($matches) {
                            $nombreUsuario = $matches[1];
                            $user = new UsuarioSA();
                            if ($user->buscaUsuario($nombreUsuario)) {
                                return '<a href="usuario.php?nombre=' . $nombreUsuario . '">@' . $nombreUsuario . '</a>';
                            } else {
                                return '@' . $nombreUsuario; // Si el usuario no existe, no se convierte en enlace
                            }
                        }, $texto_post);            
                        
                        $texto_post_con_enlaces = preg_replace_callback('/#(\w[\w.-]*)/', function($matches) {
                            $nombrePelicula = $matches[1];
                            $pelicula = new PeliculaSA();
                            if ($pelicula->obtenerPeliculaPorNombre($nombrePelicula)) {
                                return '<a href="infoPeliculas.php?nombre=' . urlencode($nombrePelicula) . '">#' . $nombrePelicula . '</a>';
                            } else {
                                return '#' . $nombrePelicula; // Si la película no existe, no se convierte en enlace
                            }
                        }, $texto_post_con_enlaces);
                        $contenidoComments .= '
                        <p class="card-text">' . $texto_post_con_enlaces . '</p>
                        <p class="card-text text-muted">' . escape($comment->getFecha()) . '</p>
                        <form action="" method="post">
                            <input type="hidden" name="id_comment_delete" value="' . escape($comment->getId()) . '">
            ';

            if (unserialize($_SESSION["user_obj"])->getNombreUsuario() === $usuarioComent->getNombreUsuario()|| unserialize($_SESSION["user_obj"])->getRole()>0) {
                $contenidoComments .= '
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-trash-alt"></i> <!-- Icono de papelera -->
                    </button>
                ';
            }

            $contenidoComments .= '
                        </form>
                    </div>
                </li>
            ';
        }

        return $contenidoComments;
    }
}

