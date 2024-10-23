<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/PeliculaSA.php';
require_once __DIR__ .'/../includes/SAs/generoSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'ModificarPelicula';

// Definir una nueva clase que extienda Formulario
class FormularioModificarPeliculas extends Formulario
{
    public $id;
    public $pelicula;

    public function __construct($id)
    {
        $campos = ['nombrePelicula', 'descripcion', 'director', 'genero', 'caratula', 'trailer'];
        parent::__construct('formModificarPelicula', ['urlRedireccion' => '../estrenos.php', 'enctype' => 'multipart/form-data', 'campos' => $campos]);
        $this->id = $id;
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
        $peliculaSA = new PeliculaSA();
        $generoSA= new generoSA();
        $pelicula = $peliculaSA->obtenerPeliculaPorID($this->id);

        $erroresCampos = self::generaErroresCampos($this->campos, $this->errores);
        $erroresGlobal = self::generaListaErroresGlobales($this->errores);

        // Obtener los valores de la película utilizando los getters
        $nombre = $pelicula->getNombre();
        $descripcion = $pelicula->getDescripcion();
        $director = $pelicula->getDirector();
        $genero = $pelicula->getGenero();
        $caratula = $pelicula->getCaratula();
        $trailer = $pelicula->getTrailer();
        $numValoraciones = $pelicula->getNumValoraciones();
        $media = $pelicula->getValoracion();
        $opcionesGenero = $generoSA->cargarGeneros();

        // Genera las opciones del selector
        $opciones = '';
        foreach ($opcionesGenero as $opcion) {
            // Verifica si la opción es igual al género de la película
            $selected = ($opcion === $genero) ? 'selected' : '';
            $opciones .= '<option value="' . $opcion . '" ' . $selected . '>' . $opcion . '</option>';
        }

        $contenidoPrincipal = <<<EOS
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="film-container">
                    <span class="form_errors">$erroresGlobal</span>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['nombrePelicula']}</span>
                            <label for="nombrePelicula">Nombre:</label>
                            <input type="text" class="form-control" id="nombrePelicula" name="nombrePelicula" value="$nombre" required>
                        </div>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['descripcion']}</span>
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" value="$descripcion" required></textarea>
                            </div>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['director']}</span>
                            <label for="director">Director:</label>
                            <input type="text" class="form-control" id="director" name="director" value="$director" required>
                        </div>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['genero']}</span>
                            <label for="genero">Género:</label>
                            <select class="form-control" id="genero" name="genero" value="$genero" required>
                                <option value="" disabled selected>Selecciona un género</option>
                                $opciones
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['caratula']}</span>
                            <label for="caratula">Carátula:</label>
                            <input type="file" class="form-control-file" id="caratula" name="caratula" accept=".png, .jpg, .jpeg, .gif" value="$caratula" required>
                        </div>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['trailer']}</span>
                            <label for="trailer">Tráiler:</label>
                            <input type="text" class="form-control" id="trailer" name="trailer" value="$trailer" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
EOS;

        return $contenidoPrincipal;
    }



    // Método para procesar los datos del formulario
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombrePelicula = htmlspecialchars(trim($datos['nombrePelicula'] ?? ''));
        if (!$nombrePelicula || strlen($nombrePelicula) > 20) {
            $this->errores['nombrePelicula'] = 'El nombre de la pelicula no puede tener ms de 20 caracteres.';
        }

        $descripcion = htmlspecialchars(trim($datos['descripcion'] ?? ''));
        if (!$descripcion || strlen($descripcion) < 5) {
            $this->errores['descripcion'] = 'La descripcion debe tener una longitud de al menos 5 caracteres.';
        }
        $director = htmlspecialchars(trim($datos['director'] ?? ''));
        if (!$director || strlen($director) < 5 || strlen($director) > 20) {
            $this->errores['director'] = 'El director debe tener una longitud de al menos 5 caracteres y de menos de 20.';
        }
        $genero = htmlspecialchars(trim($datos['genero'] ?? ''));
        if (!$genero || strlen($genero) > 30) {
            $this->errores['genero'] = 'El genero debe tener menos de 30 caracteres';
        }
        if (isset($_FILES['caratula']) && $_FILES['caratula']['error'] == 0) {
            $targetDir = __DIR__ . '/../img/';
            $fileType = strtolower(pathinfo($_FILES['caratula']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . $nombrePelicula . "." . $fileType;
            $allowedTypes = array('png', 'jpg', 'jpeg', 'gif');
            $maxFileSize = 10 * 1024 * 1024; // 10MB
            
            if (!in_array($fileType, $allowedTypes)) {
                echo $fileType;
                $this->errores['caratula'] = 'Solo se permiten archivos de tipo PNG, JPG, JPEG y GIF';
            } elseif ($_FILES['caratula']['size'] > $maxFileSize) {
                $this->errores['caratula'] = 'El tamaño de la imagen no puede superar los 10MB';
            } elseif (move_uploaded_file($_FILES['caratula']['tmp_name'], $targetFile)) {
                $caratula = $nombrePelicula . "." . $fileType;
            } else {
                echo 'Error al subir la imagen';
                $this->errores['caratula'] = 'Ha habido un error al subir la imagen';
            }
        } else {
            echo 'No se ha subido la imagen';
            $this->errores['caratula'] = 'No se ha subido la imagen';
        }
        $trailer = htmlspecialchars(trim($datos['trailer'] ?? ''));
        if (!$trailer || strlen($trailer) > 200) {
            $this->errores['trailer'] = 'La URL del trailer no puede superar los 200 caracteres';
        }

        if (count($this->errores) === 0) {
            $peliculaSA = new PeliculaSA();
            $peliculaSA->borrarPelicula($this->id);
            $peliculaSA->crearPelicula(0, $nombrePelicula, $descripcion, $director, $genero, $caratula, $trailer);
            header("Location: ../estrenos.php");
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}

