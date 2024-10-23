<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';
require_once __DIR__ . '/../DTOs/reviewDTO.php';
require_once __DIR__ . '/../DTOs/comentarioDTO.php';

class postDAO
{
    private $conexion;

    public function __construct()
    {

    }

    /*
FIX: Ahora todas las conexiones se hacen desde las funciones.
    */


    public function creaPost(postDTO $postDTO)
{
    $this->conexion = Aplicacion::getInstance()->getConexionBd();
    // Obtener los valores del postDTO
    $id_usuario = $postDTO->getIDUsuario();
    $titulo = $postDTO->getTitulo();
    $texto = $postDTO->getTexto();
    $likes = $postDTO->getLikes();

    // Preparar la consulta SQL
    $query = "INSERT INTO post (ID_usuario, titulo, texto, likes) VALUES (?, ?, ?, ?)";
    $statement = $this->conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statement) {
        die("Error al preparar la consulta: " . $this->conexion->error);
    }

    // Bind parameters
    $statement->bind_param("issi", $id_usuario, $titulo, $texto, $likes);

    // Ejecutar la consulta
    $statement->execute();

    // Verificar si se insertó correctamente
    if ($statement->affected_rows === 1) {
        echo "Post insertado correctamente.";
    } else {
        echo "Error al insertar el post: " . $this->conexion->error;
    }

    // Cerrar la declaración
    $statement->close();
}


    public function buscarPosts()
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Preparar la consulta SQL
        $query = "SELECT * FROM post";
        $result = $this->conexion->query($query);

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conexion->error);
        }

        // Crear un array para almacenar los posts
        $posts = array();

        // Obtener los resultados y mapearlos a objetos postDTO
        while ($row = $result->fetch_assoc()) {
            $post = new postDTO(
                $row['ID'],
                $row['ID_usuario'],
                $row['titulo'],
                $row['texto'],
                $row['likes']
            );
            $posts[] = $post;
        }

        // Retornar el array de posts
        return $posts;
    }

    public function buscarPostsPorUsuario($id_usuario)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Preparar la consulta SQL
        $query = "SELECT * FROM post WHERE ID_usuario = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Bind parameter
        $statement->bind_param("i", $id_usuario);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conexion->error);
        }

        // Crear un array para almacenar los posts
        $posts = array();

        // Obtener los resultados y mapearlos a objetos postDTO
        while ($row = $result->fetch_assoc()) {
            $post = new postDTO(
                $row['ID'],
                $row['ID_usuario'],
                $row['titulo'],
                $row['texto'],
                $row['likes']
            );
            $posts[] = $post;
        }

        // Cerrar la declaración
        $statement->close();

        // Retornar el array de posts
        return $posts;
    }


    public function agregarComentario($comentarioDTO)
    {
        // Establecer la conexión a la base de datos
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Obtener los valores del comentarioDTO
        $id_post = $comentarioDTO->getIdPost();
        $id_usuario = $comentarioDTO->getIDusuario(); 
        $contenido = $comentarioDTO->getContenido();

        // Preparar la consulta SQL
        $query = "INSERT INTO comentarios (id_post, id_usuario, contenido) VALUES (?, ?, ?)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Bind parameters
        $statement->bind_param("iis", $id_post, $id_usuario, $contenido);

        // Ejecutar la consulta
        $statement->execute();

        // Verificar si se insertó correctamente
        if ($statement->affected_rows === 1) {
            echo "Comentario insertado correctamente.";
        } else {
            echo "Error al insertar el comentario: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statement->close();

    }


    public function borrarPost($id_post)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Eliminar todos los comentarios asociados al post
        $queryDeleteComments = "DELETE FROM comentarios WHERE id_post = ?";
        $statementDeleteComments = $this->conexion->prepare($queryDeleteComments);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statementDeleteComments) {
            die("Error al preparar la consulta para eliminar comentarios: " . $this->conexion->error);
        }

        // Bind parameter
        $statementDeleteComments->bind_param("i", $id_post);

        // Ejecutar la consulta
        $statementDeleteComments->execute();

        // Verificar si se eliminaron los comentarios correctamente
        if ($statementDeleteComments->affected_rows < 0) {
            echo "Error al eliminar comentarios asociados al post: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statementDeleteComments->close();

        // Preparar la consulta SQL para eliminar el post
        $queryDeletePost = "DELETE FROM post WHERE ID = ?";
        $statementDeletePost = $this->conexion->prepare($queryDeletePost);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statementDeletePost) {
            die("Error al preparar la consulta para eliminar el post: " . $this->conexion->error);
        }

        // Bind parameter
        $statementDeletePost->bind_param("i", $id_post);

        // Ejecutar la consulta
        $statementDeletePost->execute();

        // Verificar si se eliminó el post correctamente
        if ($statementDeletePost->affected_rows === 1) {
            echo "Post eliminado correctamente.";
        } else {
            echo "Error al eliminar el post: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statementDeletePost->close();

    }

    public function buscarComentarios($id_post)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Array para almacenar los comentarios
        $comentarios = array();

        // Preparar la consulta SQL
        $query = "SELECT * FROM comentarios WHERE id_post = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Bind parameter
        $statement->bind_param("i", $id_post);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conexion->error);
        }

        // Obtener los resultados y mapearlos a objetos comentarioDTO
        while ($row = $result->fetch_assoc()) {
            $comentario = new comentarioDTO(
                $row['id'],
                $row['id_post'],
                $row['id_usuario'],
                $row['contenido'],
                $row['fecha']
            );
            $comentarios[] = $comentario;
        }

        // Cerrar la declaración
        $statement->close();

        // Retornar el array de comentarios
        return $comentarios;
    }

    public function borrarComentario($id_comentario)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();

        // Preparar la consulta SQL para eliminar el comentario
        $query = "DELETE FROM comentarios WHERE id = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta para eliminar el comentario: " . $this->conexion->error);
        }

        // Bind parameter
        $statement->bind_param("i", $id_comentario);

        // Ejecutar la consulta
        $statement->execute();

        // Verificar si se eliminó el comentario correctamente
        if ($statement->affected_rows === 1) {
            echo "Comentario eliminado correctamente.";
        } else {
            echo "Error al eliminar el comentario: " . $this->conexion->error;
        }

        // Cerrar la declaración
        $statement->close();

    }

    public function agregarLike($IDpost, $id_usuario)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Iniciar una transacción
        $this->conexion->begin_transaction();

        // Preparar la consulta SQL para insertar el like en la tabla likes
        $query_likes = "INSERT INTO likes (id, id_post) VALUES (?, ?)";
        $statement_likes = $this->conexion->prepare($query_likes);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement_likes) {
            die("Error al preparar la consulta para agregar like: " . $this->conexion->error);
        }

        // Bind parameters para la tabla likes
        $statement_likes->bind_param("ii", $id_usuario, $IDpost);

        // Ejecutar la consulta para la tabla likes
        $statement_likes->execute();

        // Verificar si se insertó el like correctamente en la tabla likes
        if ($statement_likes->affected_rows === 1) {
            echo "Like agregado correctamente al post con ID $IDpost.";
        } else {
            echo "Error al agregar like al post con ID $IDpost: " . $this->conexion->error;
        }

        // Cerrar la declaración de la tabla likes
        $statement_likes->close();

        // Preparar la consulta SQL para actualizar el número de likes en la tabla post
        $query_post = "UPDATE post SET likes = likes + 1 WHERE ID = ?";
        $statement_post = $this->conexion->prepare($query_post);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement_post) {
            die("Error al preparar la consulta para agregar like: " . $this->conexion->error);
        }

        // Bind parameter para la tabla post
        $statement_post->bind_param("i", $IDpost);

        // Ejecutar la consulta para la tabla post
        $statement_post->execute();

        // Verificar si se actualizó el post correctamente
        if ($statement_post->affected_rows === 1) {
            echo "Like agregado correctamente al post con ID $IDpost.";
        } else {
            echo "Error al agregar like al post con ID $IDpost: " . $this->conexion->error;
        }

        // Cerrar la declaración de la tabla post
        $statement_post->close();

        // Hacer commit de la transacción
        $this->conexion->commit();

    }

    public function usuarioDioLike($id_post, $id_usuario)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Preparar la consulta SQL para verificar si el usuario ya dio like al post
        $query = "SELECT COUNT(*) as count FROM likes WHERE id_post = ? AND id = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta para verificar si el usuario dio like: " . $this->conexion->error);
        }

        // Bind parameters
        $statement->bind_param("ii", $id_post, $id_usuario);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta para verificar si el usuario dio like: " . $this->conexion->error);
        }

        // Obtener el número de filas afectadas
        $row = $result->fetch_assoc();
        $count = $row['count'];

        // Cerrar la declaración
        $statement->close();

        // Retornar true si el usuario ya dio like, false en caso contrario
        return ($count > 0);
    }

    public function borrarLikesPorId($idPost)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Eliminar todos los likes asociados al post
        $queryDeleteLikes = "DELETE FROM likes WHERE id_post = ?";
        $statementDeleteLikes = $this->conexion->prepare($queryDeleteLikes);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statementDeleteLikes) {
            throw new Exception("Error al preparar la consulta para eliminar likes: " . $this->conexion->error);
        }

        // Bind parameter
        $statementDeleteLikes->bind_param("i", $idPost);

        // Ejecutar la consulta
        $statementDeleteLikes->execute();

        // Verificar si se eliminaron los likes correctamente
        if ($statementDeleteLikes->affected_rows < 0) {
            throw new Exception("Error al eliminar likes asociados al post: " . $this->conexion->error);
        }

        // Cerrar la conexión
        $statementDeleteLikes->close();

    }

    public function buscarIdsSeguidos($id_usuario)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Array para almacenar los ids de las personas seguidas
        $ids_seguidos = array();

        // Preparar la consulta SQL para obtener los ids de las personas seguidas
        $query = "SELECT follows FROM followers WHERE user = ?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta para obtener los usuarios seguidos: " . $this->conexion->error);
        }

        // Bind parameter
        $statement->bind_param("i", $id_usuario);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta para obtener los usuarios seguidos: " . $this->conexion->error);
        }

        // Obtener los ids de las personas seguidas y almacenarlos en el array
        while ($row = $result->fetch_assoc()) {
            $ids_seguidos[] = $row['follows'];
        }

        // Cerrar la declaración
        $statement->close();

        // Retornar el array de ids de las personas seguidas
        return $ids_seguidos;
    }

    public function buscarPostsSeguidos($id_usuario){
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
    
        // Array para almacenar los IDs de los usuarios seguidos
        $ids_seguidos = $this->buscarIdsSeguidos($id_usuario);
    
        // Si el usuario no sigue a ninguno, retornar un array vacío
        if(empty($ids_seguidos)) {
            return array();
        }
    
        // Unimos los IDs de los usuarios a una cadena para usarlos en la consulta SQL
        $ids_seguidos_str = implode(",", $ids_seguidos);
    
        // Preparar la consulta SQL para obtener los posts de los usuarios seguidos
        $query = "SELECT * FROM post WHERE ID_usuario IN ($ids_seguidos_str)";
        $result = $this->conexion->query($query);
    
        // Verificar si la consulta fue exitosa
        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conexion->error);
        }
    
        // Crear un array para almacenar los posts
        $posts = array();
    
        // Obtener los resultados y mapearlos a objetos postDTO
        while ($row = $result->fetch_assoc()) {
            $post = new postDTO(
                $row['ID'],
                $row['ID_usuario'],
                $row['titulo'],
                $row['texto'],
                $row['likes']
            );
            $posts[] = $post;
        }
    
        // Retornar el array de posts
        return $posts;
    }
    
}
