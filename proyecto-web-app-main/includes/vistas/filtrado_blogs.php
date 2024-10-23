
<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../session_start.php';

$_SESSION['ultimos']=true;
$_SESSION['seguidos']=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["ultimos"])) {
        $_SESSION["ultimos"] = true;
        $_SESSION["seguidos"] = false;
    } elseif (isset($_POST["seguidos"])) {
        $_SESSION["ultimos"] = false;
        $_SESSION["seguidos"] = true;
    }
}
class filtrado_blogs{

    public function __construct(){
        
    }
    public function filtrar(){
        return '
    <div class="container mt-3" style="background-color: #f0f0f0;">
        <div class="row justify-content-center">
            <div class="col col-md-auto">
                <form method="post">
                    <button type="submit" class="btn btn-secondary" name="ultimos" value="true">Últimos</button>
                    <button type="submit" class="btn btn-secondary" name="seguidos" value="true">Siguiendo</button>
                </form>
            </div>
        </div>
    </div>
    ';
    }


}
