<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../DAOs/postDAO.php';
require_once __DIR__ . '/../DTOs/postDTO.php';
require_once __DIR__ . '/../DAOs/reviewDAO.php';

class postSA
{
    public function __construct()
    {

    }

    public function crearPost($postDTO)
    {
        $postDAO = new postDAO();
        $postDAO->creaPost($postDTO);
        return $postDTO;
    }

    public function borraPost($id_post)
    {
        $postDAO = new postDAO();
        $postDAO->borrarLikesPorId($id_post);
        return $postDAO->borrarPost($id_post);

    }

    public function buscarPosts()
    {
        $postDAO = new postDAO();
        $posts = $postDAO->buscarPosts();
        return $posts;
    }

    public function buscarPostsPorIdUsuario($ID_usuario){
        $postDAO = new postDAO();
        $posts = $postDAO->buscarPostsPorUsuario($ID_usuario);
        return $posts;
    }

    public function buscarPostsPorUsuario($usuario)
    {
        $postDAO = new postDAO();
        $posts = $postDAO->buscarPostsPorUsuario($usuario);
        return $posts;
    }

    public function agregarComentario($comentario)
    {
        $postDAO = new postDAO();
        $postDAO->agregarComentario($comentario);
        return true;
    }

    public function borrarComentario($id_comentario)
    {
        $postDAO = new postDAO();
        return $postDAO->borrarComentario($id_comentario);
    }
    public function buscarComentarios($id_post)
    {
        $postDAO = new postDAO();
        $comentarios = $postDAO->buscarComentarios($id_post);
        return $comentarios;
    }

    public function agregarLike($id_post, $id_usuario)
    {
        $postDAO = new PostDAO();
        return $postDAO->agregarLike($id_post, $id_usuario);
    }

    public function usuarioDioLike($id, $id_usuario)
    {
        $postDAO = new postDAO();
        return $postDAO->usuarioDioLike($id, $id_usuario);
    }

    public function postsSeguidos($id_usuario)
    {
        $postDAO = new postDAO();
     
        return $postDAO->buscarPostsSeguidos($id_usuario);
    }
}

