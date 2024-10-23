<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';

class generoDAO {

    function __construct(){

    }

    /*
    Inserta un genero en la tabla de 'generos'
    */
    public function creaGenero($genero) {
        $conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "INSERT INTO generos (genero) VALUES (?)";
        $statement = $conexion->prepare($query);

        if (!$statement) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        $statement->bind_param("s", $genero);
        $statement->execute();

        if ($statement->affected_rows === 1) {
            echo "Género insertado correctamente.";
        } else {
            echo "Error al insertar el género: " . $conexion->error;
        }

        $statement->close();
    }

    /*
    Borra el genero seleccionado, en caso de no encontrarlo no realiza nada
    */
    public function borraGenero($genero) {
        $conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM generos WHERE genero = ?";
        $statement = $conexion->prepare($query);

        if (!$statement) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        $statement->bind_param("s", $genero);
        $statement->execute();

        if ($statement->affected_rows === 1) {
            echo "Género eliminado correctamente.";
        } else {
            echo "No se encontró el género para eliminar.";
        }

        $statement->close();
    }

    /*
    Devuelve true si encuentra el genero, en caso contrario devuelve false
    */
    public function buscaGenero($genero) {
        $conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM generos WHERE genero = ?";
        $statement = $conexion->prepare($query);

        if (!$statement) {
            die("Error al preparar la consulta: " . $conexion->error);
        }

        $statement->bind_param("s", $genero);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }

        $statement->close();
    }

    /*
    Devuelve un array de todos los generos de la tabla.
    */
    public function cargarGeneros() {
        $conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM generos";
        $result = $conexion->query($query);

        if (!$result) {
            die("Error al ejecutar la consulta: " . $conexion->error);
        }

        $generos = array();

        while ($row = $result->fetch_assoc()) {
            $generos[] = $row['genero'];
        }

        return $generos;
    }
}
