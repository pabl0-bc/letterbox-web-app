<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/../includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'Login';

// Definir una nueva clase que extienda Formulario
class FormularioLogin extends Formulario
{
    public $ID = '';
    public $pelicula = '';


    public function __construct()
    {
        $campos = ['username', 'password'];
        parent::__construct('formLogin', ['urlRedireccion' => '../estrenos.php', 'campos' => $campos]);
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {

        $erroresCampos = self::generaErroresCampos($this->campos, $this->errores);

        $erroresGlobal = self::generaListaErroresGlobales($this->errores);

        $contenidoPrincipal = <<<EOS
        <div class="login-content">
            <div class="login-container">
                <h2>Login</h2>
                <span class="form_errors">$erroresGlobal</span>
                    <span class="form_errors">{$erroresCampos['username']}</span>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
    
                    <span class="form_errors">{$erroresCampos['password']}</span>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
    
                    <button type="submit">Login</button>
    
                <div class="create-account-link">
                    <p>If you don't have an account, <a href="registro.php">create one</a>.</p>
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

    $username = trim($datos['username'] ?? ''); // Corregido el índice
    if (empty($username)) {
        $this->errores['username'] = 'El nombre del usuario no puede estar vacío'; // Añadido al array sin clave específica
    }

    $password = trim($datos['password'] ?? ''); // Corregido el índice
    if (empty($password)) {
        $this->errores['password'] = 'La contraseña no puede estar vacía'; // Añadido al array sin clave específica
    }

    if (count($this->errores) === 0) {
        $usuarioSA = new UsuarioSA();
        $usuario = $usuarioSA->login($username, $password);
        if (!$usuario) {
            $this->errores[] = "El usuario o la contraseña no coinciden"; // Corregido el mensaje de error
        } else {
            $_SESSION['login'] = true;
            $_SESSION['user_obj'] = serialize($usuario);
            header("Location: estrenos.php"); // Redirige al usuario después del inicio de sesión exitoso
            exit(); // Detiene la ejecución del script después de la redirección
        }
    }
}


    // Método para mostrar el formulario
    public function mostrarFormulario()
    {
        echo $this->generaFormulario();
    }
}
