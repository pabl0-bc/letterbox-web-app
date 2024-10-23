<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../DAOs/peliculaDAO.php';
require_once __DIR__ . '/../DTOs/PeliculaDTO.php';
require_once __DIR__ . '/../DAOs/reviewDAO.php';
class PeliculaSA
{
    public function __construct()
    {

    }

    public function crearPelicula($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = new PeliculaDTO($ID, $nombre, $descripcion, $director, $genero, $caratula, $trailer,0,0);
        $peliculaDAO->crearPelicula($pelicula);
        return $pelicula;
    }

    public function borrarPelicula($ID)
    {
        $peliculaDAO = new PeliculaDAO();
        $peliculaDAO->borrarPelicula($ID);
        return true;
    }

    public function modificarPelicula(PeliculaDTO $pelicula)
    {
        $peliculaDAO = new PeliculaDAO();
        $peliculaDAO->modificarPelicula($pelicula);

    }

    public function obtenerPeliculaPorID($id)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = $peliculaDAO->obtenerPeliculaPorID($id);
        return $pelicula;

    }

    public function obtenerPeliculaPorNombre($nombre)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = $peliculaDAO->obtenerPeliculaPorNombre($nombre);
        return $pelicula;
    }

    public function filtrarPeliculasPorGenero($genero, $skip)
    {
        $peliculaDAO = new PeliculaDAO();
        $peliculas = $peliculaDAO->filtrarPeliculasPorGenero($genero, $skip);
        return $peliculas;
    }

    public function obtenerListaPeliculas($skip)
    {
        $peliculaDAO = new PeliculaDAO();
        $pelicula = $peliculaDAO->obtenerListaPeliculas($skip);
        return $pelicula;
    }

    public function realizarMedia(PeliculaDTO $pelicula)
    {
        $peliculaDAO = new PeliculaDAO();
        $reviewDAO = new ReviewDAO();
        $reviews = $reviewDAO->obtenerReviewPorPelicula($pelicula->getNombre());
        $peliculaDAO->realizarMedia($pelicula,$reviews );
        return true;
    }

    public function buscarPeliculasQueEmpecienPor($term){
        $peliculaDAO = new PeliculaDAO();
        $pelicula = $peliculaDAO->buscarPeliculasQueEmpecienPor($term);
        return $pelicula;
    }

    public function obtenerPeliculasSugeridas($term){

        return PeliculaDAO::obtenerPeliculasSugeridas($term);
    }
}

