<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../SAs/postSA.php';
require_once __DIR__ . '/../SAs/PeliculaSA.php';

require_once 'mostrarComentarios.php';

class mostrarPosts
{
    public function __construct()
    {
    }

    public function construirPosts($posts, $usuario)
    {
        $contenidoPosts = '<div class="container">'; // Inicializa la variable fuera del bucle

        foreach ($posts as $post) {
            $contenidoPosts .= '
                <div class="mt-3">
                    <div class="card mb-4">
                        <div class="media px-3 pt-3">
            ';

            $usuarioSA = new UsuarioSA();
            $postSA = new postSA();
            $usuarioPost = $usuarioSA->buscaPorId($post->getIDUsuario());
            $contenidoPosts .= '
            <div class="media-body">
                <h5 class="mt-0"><a href="usuario.php?nombre=' . urlencode($usuarioPost->getNombreUsuario()) . '"> <img src="img/' . $usuarioPost->getProfileImage() . '" alt="Avatar" class="rounded-circle mr-2" style="width: 40px; height: 40px;">@' . escape($usuarioPost->getNombreUsuario()) . ($usuarioPost->getRole() == 2 ? '<i class="fas fa-check-circle text-primary"></i>' : ($usuarioPost->getRole() == 1 ? '<i class="fas fa-check-circle text-warning"></i>' : '')) . '</a></h5>
                </div>
                     </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">' . escape($post->getTitulo()) . '</h6>
                            ';
            $texto_post = $post->getTexto();

            $texto_post_con_enlaces = preg_replace_callback('/@(\w[\w.-]*)/', function ($matches) {
                $nombreUsuario = $matches[1];
                $user = new UsuarioSA();
                if ($user->buscaUsuario($nombreUsuario)) {
                    return '<a href="usuario.php?nombre=' . $nombreUsuario . '">@' . $nombreUsuario . '</a>';
                } else {
                    return '@' . $nombreUsuario; // Si el usuario no existe, no se convierte en enlace
                }
            }, $texto_post);

            $texto_post_con_enlaces = preg_replace_callback('/#(\w[\w.-]*)/', function ($matches) {
                $nombrePelicula = $matches[1];
                $pelicula = new PeliculaSA();
                if ($pelicula->obtenerPeliculaPorNombre($nombrePelicula)) {
                    return '<a href="infoPeliculas.php?nombre=' . urlencode($nombrePelicula) . '">#' . $nombrePelicula . '</a>';
                } else {
                    return '#' . $nombrePelicula; // Si la película no existe, no se convierte en enlace
                }
            }, $texto_post_con_enlaces);

            $contenidoPosts .= '
                            <p class="card-text" style="text-decoration: none;">' . $texto_post_con_enlaces . '</p>
                            <p class="card-text">Likes: ' . escape($post->getLikes()) . '</p>
            ';
            if (isset($_SESSION["user_obj"])) {
                if ($usuario === $usuarioSA->buscaNombrePorId($post->getIDUsuario()) || unserialize($_SESSION["user_obj"])->getRole() == 1 || unserialize($_SESSION["user_obj"])->getRole() == 1) {
                    $contenidoPosts .= '
                        <!-- Formulario para eliminar el post -->
                        <form action="" method="post">
                            <input type="hidden" name="id_post_delete" value="' . escape($post->getID()) . '">
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-trash-alt"></i> <!-- Icono de papelera -->
                            </button>
                        </form>
                    ';
                }
            }
            if ($usuario !== $usuarioSA->buscaNombrePorId($post->getIDUsuario()) && !$postSA->usuarioDioLike($post->getID(), $usuario)) {
                $contenidoPosts .= '
                    <!-- Formulario para dar like -->
                    <form action="" method="post">
                        <input type="hidden" name="id_post_like" value="' . escape($post->getID()) . '">
                        <button type="submit" class="btn btn-primary">Like</button>
                    </form>
                ';
            } elseif ($postSA->usuarioDioLike($post->getID(), $usuario)) {
                $contenidoPosts .= '<p class="text-muted">Ya has dado like a este post.</p>';
            }
            if (isset($_SESSION['user_obj'])) {
                $contenidoPosts .= '
                            </div>
                            <button class="btn btn-link" onclick="toggleComments(' . escape($post->getID()) . ')">Mostrar/ocultar comentarios</button>
                            <div id="comments-' . escape($post->getID()) . '" style="display: none;">
                                <div id="comments-body-' . escape($post->getID()) . '">
                                    <form id="form-comment-' . escape($post->getID()) . '" action="" method="post">
                                        <h2>Escribe tu comentario:</h2>
                                        <div class="form-group">
                                            <textarea id="contenido-' . escape($post->getID()) . '" data-postid="' . escape($post->getID()) . '" class="form-control" name="contenido" rows="2" placeholder="Escribe tu comentario..." required></textarea>
                                            <div id="sugerencias-' . escape($post->getID()) . '"></div>
                                        </div>
                                        <input type="hidden" name="id_post" value="' . escape($post->getID()) . '">
                                        <button type="submit" class="btn btn-primary">Comentar</button>
                                    </form>
                                    <h3>Respuestas:</h3>
                                </div>
                                <div id="comments-list-' . escape($post->getID()) . '">
            ';
            }
            // Aquí llamamos a la función para construir los comentarios
            $mostrarComentarios = new mostrarComentarios();
            $contenidoPosts .= $mostrarComentarios->construirComentarios($post->getID(), $usuarioSA->buscaNombrePorId($post->getIDUsuario()));

            $contenidoPosts .= '
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        ';
        }

        $contenidoPosts .= '';

        return $contenidoPosts;
    }

    public function existeUsuario($usuarioSA, $nombreUsuario)
    {
        return $usuarioSA->buscaUsuario($nombreUsuario);
    }

}

?>
<script src="<?= RUTA_JS ?>/scripts.js"></script>