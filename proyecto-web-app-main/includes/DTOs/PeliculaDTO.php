<?php
class PeliculaDTO
{
    public $ID;
    public $nombre;
    public $descripcion;
    public $director;
    public $genero;
    public $caratula;
    public $trailer;
    public $num_valoraciones; //Numero de reviews hecho a la pelicula
    public $valoracion;//Media de valoraciones de la pelicula

    public function __construct($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer, $num_valoraciones, $valoracion)
    {
        $this->setPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer, $num_valoraciones, $valoracion);
    }

    private function setPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer, $num_valoraciones, $valoracion)
    {
        $this->ID = $ID;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->director = $director;
        $this->genero = $genero;
        $this->caratula = $caratula;
        $this->trailer = $trailer;
        $this->num_valoraciones = $num_valoraciones;
        $this->valoracion = $valoracion;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getDirector()
    {
        return $this->director;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getCaratula()
    {
        return $this->caratula;
    }

    public function getTrailer()
    {
        return $this->trailer;
    }

    public function getValoracion()
    {
        return $this->valoracion;
    }

    public function getNumValoraciones()
    {
        return $this->num_valoraciones;
    }
    public function getPelicula()
    {
        $valores = array(
            'ID' => $this->ID,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'director' => $this->director,
            'genero' => $this->genero,
            'caratula' => $this->caratula,
            'trailer' => $this->trailer,
            'numValoraciones' => $this->num_valoraciones,
            'valoracion' => $this->valoracion
        );
        return $valores;

    }
public function setValoracion($media){
    $this->valoracion=$media;
}

}


