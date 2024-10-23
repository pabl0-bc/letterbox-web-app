<?php

class comentarioDTO{
public $id;

public $id_post;

public $id_usuario;

public $contenido;

public $fecha;

public function __construct($id, $id_post, $id_usuario, $contenido, $fecha){
$this->setComentario($id, $id_post, $id_usuario, $contenido, $fecha);
}

public function setComentario($id, $id_post, $id_usuario, $contenido, $fecha){
    $this->id=$id;
    $this->id_post= $id_post;
    $this->id_usuario= $id_usuario;
    $this->contenido= $contenido;
    $this->fecha= $fecha;
}

public function getID(){
    return $this->id;
}

public function getIdPost(){
    return $this->id_post;
}

public function getIDusuario(){
    return $this->id_usuario;
}

public function getContenido(){
    return $this->contenido;
}

public function getFecha(){
    return $this->fecha;
}

public function getComentario(){
  
        $valores = array(
            'ID' => $this->id,
            'idPost' => $this->id_post,
            'id_usuario' => $this->id_usuario,
            'contenido' => $this->contenido,
            'fecha' => $this->fecha
            
        );
        return $valores;
}
}