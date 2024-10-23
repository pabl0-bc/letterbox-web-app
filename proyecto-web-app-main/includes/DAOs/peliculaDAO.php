<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';

class PeliculaDAO
{
    private $conexion;

    public function __construct()
    {
        //En el constructor nos conectamos a la BD
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web_app_proyecto";

        // Aquí deberías establecer la conexión a la base de datos
    }

    public function crearPelicula(PeliculaDTO $pelicula)
    {
        // Preparar la consulta SQL
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "INSERT INTO peliculas (nombre, descripcion, director, genero, caratula, trailer, numValoraciones, valoracion) VALUES (?, ?, ?, ?, ?, ?, 0, 0)";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener los valores de la película y filtrarlos
        $valores = $pelicula->getPelicula();
        $nombre = html_entity_decode($valores['nombre']);
        $descripcion = html_entity_decode($valores['descripcion']);
        $director = html_entity_decode($valores['director']);
        $genero = html_entity_decode($valores['genero']);
        $caratula = html_entity_decode($valores['caratula']);
        $trailer = html_entity_decode($valores['trailer']);

        // Escape de los valores para prevenir inyección SQL
        $nombre = $this->conexion->real_escape_string($nombre);
        $descripcion = $this->conexion->real_escape_string($descripcion);
        $director = $this->conexion->real_escape_string($director);
        $genero = $this->conexion->real_escape_string($genero);
        $caratula = $this->conexion->real_escape_string($caratula);
        $trailer = $this->conexion->real_escape_string($trailer);

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("ssssss", $nombre, $descripcion, $director, $genero, $caratula, $trailer);
        $statement->execute();

        // Verificar si se insertó alguna fila
        $rows_affected = $statement->affected_rows;

        // Cerrar la declaración
        $statement->close();

        // Retornar verdadero si se insertó alguna fila, falso de lo contrario
        return $rows_affected > 0;
    }

    public function borrarPelicula($ID)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Validar el parámetro ID
        if (!is_numeric($ID) || $ID <= 0) {
            // Manejar el error de ID no válido
            return false;
        }

        // Escape de la variable $ID
        $ID = $this->conexion->real_escape_string($ID);

        // Consulta preparada con marcadores de posición sin nombres específicos
        $query = "DELETE FROM peliculas WHERE ID = ?";
        $statement = $this->conexion->prepare($query);
        if (!$statement) {
            // Manejar el error al preparar la consulta
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Ejecutar la consulta con el parámetro ID
        $statement->bind_param("i", $ID); // "i" indica que $ID es un entero
        $statement->execute();

        // Manejar errores en la ejecución de la consulta
        if ($statement->error) {
            // Manejar el error de ejecución de la consulta
            die("Error al ejecutar la consulta: " . $statement->error);
        }

        // Verificar si se eliminó alguna fila
        return $statement->affected_rows > 0;
    }

    public function obtenerPeliculaPorID($ID)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM peliculas WHERE ID = ?";
        $statement = $this->conexion->prepare($query);
        $statement->bind_param("i", $ID); // "i" indica que $ID es un integer
        $statement->execute();
        $result = $statement->get_result();
    
        // Obtener la fila de resultados como un array asociativo
        $peliculaData = $result->fetch_assoc();
    
        if ($peliculaData != null) {
            // Crear un nuevo objeto PeliculaDTO con los datos recuperados
            $peliculaDTO = new PeliculaDTO(
                $peliculaData['ID'],
                $peliculaData['nombre'],
                $peliculaData['descripcion'],
                $peliculaData['director'],
                $peliculaData['genero'],
                $peliculaData['caratula'],
                $peliculaData['trailer'],
                $peliculaData['numValoraciones'],
                $peliculaData['valoracion']
            );
    
            return $peliculaDTO;
        } else {
            return null; // Opcional: Manejo de caso en el que no se encuentra ninguna película con el nombre especificado
        }
    }
    

    public function obtenerPeliculaPorNombre($nombre)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        $nombre = str_replace('_', ' ', $nombre);
        $query = "SELECT * FROM peliculas WHERE REPLACE(nombre, '_', ' ') = ?";
        $statement = $this->conexion->prepare($query);
        $statement->bind_param("s", $nombre); // "s" indica que $nombre es una cadena
        $statement->execute();
        $result = $statement->get_result();

        // Obtener la fila de resultados como un array asociativo
        $peliculaData = $result->fetch_assoc();

        if ($peliculaData != null) {
            // Crear un nuevo objeto PeliculaDTO con los datos recuperados
            $peliculaDTO = new PeliculaDTO(
                $peliculaData['ID'],
                $peliculaData['nombre'],
                $peliculaData['descripcion'],
                $peliculaData['director'],
                $peliculaData['genero'],
                $peliculaData['caratula'],
                $peliculaData['trailer'],
                $peliculaData['numValoraciones'],
                $peliculaData['valoracion']
            );

            return $peliculaDTO;
        } else {
            return null; // Opcional: Manejo de caso en el que no se encuentra ninguna película con el nombre especificado
        }
    }

    public function filtrarPeliculasPorGenero($genero, $skip)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        if ($genero == "Todos") {
            return $this->obtenerListaPeliculas($skip);
        }
        // Consulta SQL para obtener todas las películas del género especificado
        $query = "SELECT * FROM peliculas WHERE genero = ?";

        // Preparar la consulta SQL
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Ejecutar la consulta con el género proporcionado
        $statement->bind_param("s", $genero); // "s" indica que $genero es una cadena
        $statement->execute();

        // Obtener el resultado de la consulta
        $result = $statement->get_result();

        // Crear un array para almacenar las películas del género especificado
        $peliculas = array();

        // Recorrer los resultados y crear objetos PeliculaDTO
        while ($row = $result->fetch_assoc()) {
            $pelicula = new PeliculaDTO(
                $row['ID'],
                $row['nombre'],
                $row['descripcion'],
                $row['director'],
                $row['genero'],
                $row['caratula'],
                $row['trailer'],
                $row['numValoraciones'],
                $row['valoracion']
            );
            // Agregar la película al array
            $peliculas[] = $pelicula;
        }

        // Retornar el array de películas del género especificado
        return $peliculas;
    }

    public function obtenerListaPeliculas($skip)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM peliculas LIMIT 12 OFFSET $skip";

        $statement = $this->conexion->prepare($query);

        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        $statement->execute();

        $result = $statement->get_result();

        $peliculas = array();

        while ($row = $result->fetch_assoc()) {
            $pelicula = new PeliculaDTO(
                $row['ID'],
                $row['nombre'],
                $row['descripcion'],
                $row['director'],
                $row['genero'],
                $row['caratula'],
                $row['trailer'],
                $row['numValoraciones'],
                $row['valoracion']
            );
            $peliculas[] = $pelicula;
        }

        return $peliculas;
    }
    public function modificarPelicula(PeliculaDTO $pelicula)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        // Preparar la consulta SQL
        $query = "UPDATE peliculas SET nombre=?, descripcion=?, director=?, genero=?, caratula=? WHERE ID=?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener los valores de la película
        $valores = $pelicula->getPelicula();

        // Obtener el ID de la película
        $id = $valores['ID'];

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("sssssi", $valores['nombre'], $valores['descripcion'], $valores['director'], $valores['genero'], $valores['caratula'], $id);
        $statement->execute();

        // Verificar si se modificó alguna fila
        $rows_affected = $statement->affected_rows;

        // Cerrar la declaración
        $statement->close();

        // Retornar verdadero si se modificó alguna fila, falso de lo contrario
        return $rows_affected > 0;
    }

 
    public function realizarMedia(PeliculaDTO $pelicula, array $reviews)
    {
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        $suma = 0;
        $contador = 0;
        foreach ($reviews as $review) {
            $contador++;
            $suma += $review->getPuntuacion();
        }
        if ($contador != 0)
            $media = $suma / $contador;
        else
            $media = 0;
        $pelicula->setValoracion($media);
        $this->modificarMedia($pelicula, $media);
    }

    public function modificarMedia(PeliculaDTO $pelicula, $media)
    {
        // Preparar la consulta SQL
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "UPDATE peliculas SET valoracion=? WHERE ID=?";
        $statement = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }

        // Obtener el ID de la película
        $id = $pelicula->getID();

        // Ejecutar la consulta con los valores proporcionados
        $statement->bind_param("di", $media, $id); // "di" indica que $media es un double y $id es un integer
        $statement->execute();

        // Verificar si se modificó alguna fila
        $rows_affected = $statement->affected_rows;

        // Cerrar la declaración
        $statement->close();

        // Retornar verdadero si se modificó alguna fila, falso de lo contrario
        return $rows_affected > 0;
    }

    public function buscarPeliculasQueEmpecienPor($term){
        $this->conexion = Aplicacion::getInstance()->getConexionBd();
    $query = "SELECT * FROM peliculas WHERE nombre LIKE ? LIMIT 10;";

    $statement = $this->conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if (!$statement) {
        die("Error al preparar la consulta: " . $this->conexion->error);
    }

    // No necesitas vincular ningún parámetro en este caso

    $term = '%' . $term . '%';
    $statement->bind_param("s", $term);
        $statement->execute();

        $result = $statement->get_result();

        $peliculas = array();

        while ($row = $result->fetch_assoc()) {
            $pelicula = new PeliculaDTO(
                $row['ID'],
                $row['nombre'],
                $row['descripcion'],
                $row['director'],
                $row['genero'],
                $row['caratula'],
                $row['trailer'],
                $row['numValoraciones'],
                $row['valoracion']
            );
            $peliculas[] = $pelicula;
        }

        return $peliculas;
    }

    public static function obtenerTotalPeliculas(){

        $conexion = Aplicacion::getInstance()->getConexionBd();
        
        $query = "SELECT COUNT(*) AS total FROM peliculas";
        $statement = $conexion->prepare($query);

        if (!$statement) {
            die("Error al preparar la consulta: " . $conexion->error);
        }
        
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public static function obtenerPeliculasSugeridas($term){
        $conexion = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM peliculas WHERE nombre LIKE ? LIMIT 10;";
    
        $statement = $conexion->prepare($query);
    
        // Verificar si la preparación de la consulta fue exitosa
        if (!$statement) {
            die("Error al preparar la consulta: " . $conexion->error);
        }
    
        // No necesitas vincular ningún parámetro en este caso
    
        $term = $term . '%';
        $statement->bind_param("s", $term);
            $statement->execute();
    
            $result = $statement->get_result();
    
            $peliculas = array();
    
            while ($row = $result->fetch_assoc()) {
                $pelicula = new PeliculaDTO(
                    $row['ID'],
                    $row['nombre'],
                    $row['descripcion'],
                    $row['director'],
                    $row['genero'],
                    $row['caratula'],
                    $row['trailer'],
                    $row['numValoraciones'],
                    $row['valoracion']
                );
                $peliculas[] = $pelicula;
            }
    
            return $peliculas;
        }
}

