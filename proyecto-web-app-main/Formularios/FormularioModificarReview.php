<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/SAs/reviewSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'ModificarPelicula';

// Definir una nueva clase que extienda Formulario
class FormularioModificarReview extends Formulario{
    public $id;
    public $review;

  public function __construct($id) {
    $campos = ['titulo', 'critica', 'puntuacion'];
    parent::__construct('formModificarReview', ['urlRedireccion' => '../estrenos.php', 'campos' => $campos]);
    $this->id = $id;
    $reviewSA = new reviewSA();
    $this->review = $reviewSA->obtenerReviewPorID($this->id);
}
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {
       
        $titulo = $this->review->getTitulo();
        $critica = $this->review->getCritica();
        $puntuacion = $this->review->getPuntuacion();

        $erroresCampos = self::generaErroresCampos($this->campos, $this->errores);
        $erroresGlobal = self::generaListaErroresGlobales($this->errores);
    
        $contenidoPrincipal = <<<EOS
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="film-container">
                        <span class="form_errors">$erroresGlobal</span>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['titulo']}</span>
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="$titulo" required>
                        </div>
                        <div class="form-group">
                            <span class="form_errors">{$erroresCampos['critica']}</span>
                            <label for="critica">Crítica:</label>
                            <textarea class="form-control" id="critica" name="critica" rows="4" value="$critica" required></textarea>
                        </div>
                        <div class="form-group">
                        <span class="form_errors">{$erroresCampos['puntuacion']}</span>
                            <label for="puntuacion">Puntuación:</label>
                            <select class="form-control" id="puntuacion" name="puntuacion" value="$puntuacion" required>
                                <option value="">Selecciona una puntuación</option>
                                <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
                                <option value="4">&#9733;&#9733;&#9733;&#9733;</option>
                                <option value="3">&#9733;&#9733;&#9733;</option>
                                <option value="2">&#9733;&#9733;</option>
                                <option value="1">&#9733;</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Agregar</button>
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

        $tituloReview = htmlspecialchars(trim($datos['titulo'] ?? ''));
        if (!$tituloReview) {
            $this->errores['titulo'] = 'El título de la crítica no puede estar vacío.';
        }
        if (strlen($tituloReview) > 100) {
            $this->errores['titulo'] = 'El título de la crítica no puede tener más de 100 caracteres.';
        }
        $critica = htmlspecialchars(trim($datos['critica'] ?? ''));
        if (!$critica) {
            $this->errores['critica'] = 'La crítica no puede estar vacía.';
        }
        if (strlen($critica) > 1000) {
            $this->errores['critica'] = 'La crítica debe tener menos de 300 caracteres.';
        }

        $puntuacion = trim($datos['puntuacion'] ?? '');
        $puntuacion = filter_var($puntuacion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (count($this->errores) === 0) {
                $reviewSA = new reviewSA();
                $reviewSA->borrarReview($this->id);
                $reviewSA->crearReview($this->id, $this->review->getUsuario(), $tituloReview, $critica, $puntuacion, $this->review->getPelicula());
                header("Location: ../estrenos.php");
        }
    }

    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}

