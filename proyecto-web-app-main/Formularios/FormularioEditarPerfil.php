<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/session_start.php';
require_once __DIR__ . '/../includes/DTOs/UsuarioDTO.php';
require_once __DIR__ . '/../includes/SAs/UsuarioSA.php';
require_once __DIR__ . '/Formulario.php';

$tituloPagina = 'Editar Perfil';

class FormularioEditarPerfil 
{
    protected $campos;
    protected $errores = [];


    public function __construct()
    {
        $this->campos = ['new_username', 'new_email', 'new_password', 'new_profile_image', 'password'];  
    }

    // Método para generar los campos del formulario
    public function generaCamposFormularioPopUp($nombre)
    {
        $contenidoPrincipal = 
        <<<EOS
            <div class="popup-content">
                <h2>Editar Perfil</h2>
                <form enctype="multipart/form-data" id="edit-form">
                    <input type="hidden" id="username" name="username" value="{$nombre}" required>

                    <label for="new_username">Edita su nombre:</label>
                    <input type="text" id="new_username" name="new_username" value="{$nombre}" required>

                    <label for="new_email">Edita su email:</label>
                    <input type="email" id="new_email" name="new_email">

                    <label for="new_password">Edita su contraseña:</label>
                    <input type="password" id="new_password" name="new_password">

                    <label for="new_profile_image">Edita su imagen de perfil:</label>
                    <input type="file" id="new_profile_image" name="new_profile_image" accept="image/*">

                    <label for="password">Introduce tu contraseña para confirmar los cambios:</label>
                    <input type="password" id="password" name="password" required>

                    <button id="save-edit" type="submit">Guarda</button>
                    <button id="closeBtn" type="button" class="closeBtn">Cerrar</button>
                </form>
            </div>
        EOS;
        return $contenidoPrincipal;
    }

}
