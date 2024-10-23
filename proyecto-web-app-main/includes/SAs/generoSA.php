<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../DAOs/generoDAO.php';
class generoSA
{

    function __construct()
    {

    }

    /*
Si el genero aun no ha sido creado se crea
    */
    public function creaGenero($genero)
    {
        $generoDAO = new generoDAO();
        if (!$this->buscaGenero($genero))
            return $generoDAO->creaGenero($genero);
        else
            return false;
    }
    /*
Si el genero existe se borra
    */
    public function borraGenero($genero)
    {
        $generoDAO = new generoDAO();
        if ($this->buscaGenero($genero))
            return $generoDAO->borraGenero($genero);
        else
            return false;
    }
/*
busca si existe o no un genero
*/
    public function buscaGenero($genero)
    {
        $generoDAO = new generoDAO();
        return $generoDAO->buscaGenero($genero);
    }
    /*
Carga un array con los generos existentes
    */
    public function cargarGeneros()
    {
        $generoDAO = new generoDAO();
        return $generoDAO->cargarGeneros();//DEVUELVE UN ARRAY
    }
}