<?php
class postDTO
{
    public $ID;

    public $ID_usuario;
    public $usuario; //Nombre del usuario
    public $titulo;
    public $texto;
    public $likes;

    public function __construct($ID, $ID_usuario, $titulo, $texto, $likes)
    {
        $this->setPost($ID, $ID_usuario, $titulo, $texto, $likes);
    }

    private function setPost($ID,$ID_usuario, $titulo, $texto, $likes)
    {
        $this->ID = $ID;
        $this->ID_usuario= $ID_usuario;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->likes = $likes;

    }

    public function getID()
    {
        return $this->ID;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function getIDusuario(){
        return $this->ID_usuario;
    }

    public function getPost()
    {
        $valores = array(
            'ID' => $this->ID,
            'ID_usuario' => $this->ID_usuario,
            'titulo' => $this->titulo,
            'texto' => $this->texto,
            'likes' => $this->likes

        );
        return $valores;
    }
}


