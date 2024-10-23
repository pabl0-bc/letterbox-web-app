<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/../includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'Registro';

// Definir una nueva clase que extienda Formulario
class FormularioRegistro extends Formulario
{
        public function __construct()
    {
        $campos = ['username', 'password', 'email', 'profile_image'];
        parent::__construct('formRegistro', ['urlRedireccion' => '../estrenos.php', 'enctype' => 'multipart/form-data', 'campos' => $campos]);
    }
    // Método para generar los campos del formulario
    protected function generaCamposFormulario(&$datos)
    {

        $erroresCampos = self::generaErroresCampos($this->campos, $this->errores);
        $erroresGlobal = self::generaListaErroresGlobales($this->errores);

        if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
            $contenidoPrincipal = <<<EOS
            <div class="login-content">
                <div class="title_container">
                    <p>You are already logged in!</p>
                    <p>Welcome {$_SESSION['username']}!</p>
                </div>
            </div>
            EOS;
        } else {
            $contenidoPrincipal = <<<EOS
            <div class="login-content">
                <div class="login-container">
                    <h2>Create account</h2>
                    <span class="form_errors">$erroresGlobal</span>
                    <span class="form_errors">{$erroresCampos['username']}</span>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
    
                    <span class="form_errors">{$erroresCampos['email']}</span>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
    
                    <span class="form_errors">{$erroresCampos['password']}</span>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <span class="form_errors">{$erroresCampos['profile_image']}</span>
                    <label for="profile_image">Profile image: (Opcional)</label>
                    <input type="file" id="profile_image" name="profile_image" accept=".png, .jpg, .jpeg, .gif">

                    <button type="submit">Submit</button>        
                    <div class="create-account-link">
                        <p>If you already have an account, <a href="login.php">login</a>.</p>
                    </div>
                </div>
            </div>
            EOS;
    }
    return $contenidoPrincipal;
}
    
    

    // Método para procesar los datos del formulario
    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $username = trim($datos['username'] ?? ''); 
        if (empty($username)) {
            $this->errores['username'] = 'El nombre del usuario no puede estar vacío'; 
        }
    
        $password = trim($datos['password'] ?? ''); 
        if (empty($password)) {
            $this->errores['password'] = 'La contraseña no puede estar vacía'; 
        }

        $email = trim($datos['email'] ?? ''); 
        if (empty($email)) {
            $this->errores['email'] = 'El email no puede estar vacio'; 
        }

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $targetDir = __DIR__ . '/../img/';
            $fileType = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $targetFile = $targetDir . $username . "." . $fileType;
            $allowedTypes = array('png', 'jpg', 'jpeg', 'gif');
            $maxFileSize = 5 * 1024 * 1024; // 5MB

            if (!in_array($fileType, $allowedTypes)) {
                $this->errores['profile_image'] = 'Solo se permiten archivos de tipo PNG, JPG, JPEG y GIF';
            } elseif ($_FILES['profile_image']['size'] > $maxFileSize) {
                $this->errores['profile_image'] = 'El tamaño de la imagen no puede superar los 5MB';
            } elseif (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
                $profile_image = $username . "." . $fileType;
            } else {
                echo 'Error al subir la imagen';
                $this->errores['profile_image'] = 'Ha habido un error al subir la imagen';
            }
        } else {
            $profile_image = "user_default.png";
        }
    
        if (count($this->errores) === 0) {
            $usuarioSA = new UsuarioSA();
            if($usuarioSA->buscaUsuario($username)){
                $this->errores[] = "El usuario ya existe"; // Corregido el mensaje de error
            } else{
                $usuario= $usuarioSA->crea($username, $password, $email, 0, $profile_image);
                header("Location: login.php"); // Redirige al usuario después del inicio de sesión exitoso
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
