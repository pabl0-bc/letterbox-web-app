<?php

class UsuarioDAO
{

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }
    
    public static function crea($nombreUsuario, $password, $email, $role, $profile_image)
    {
        $user = new UsuarioDTO($nombreUsuario, self::hashPassword($password), $email, $role, null, [], [], $profile_image);
        return self::guarda($user);
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $query_followers = "SELECT * FROM followers WHERE follows=?";
                $stmt_followers = $conn->prepare($query_followers);
                $stmt_followers->bind_param("s", $fila['id']);
                $stmt_followers->execute();
                $rs_followers = $stmt_followers->get_result();
                $followers = array();
                while ($fila_followers = $rs_followers->fetch_assoc()) {
                    array_push($followers, $fila_followers['user']);
                }
                $rs_followers->free();
                $query_following = "SELECT * FROM followers WHERE user=?";
                $stmt_following = $conn->prepare($query_following);
                $stmt_following->bind_param("s", $fila['id']);
                $stmt_following->execute();
                $rs_following = $stmt_following->get_result();
                $following = array();
                while ($fila_following = $rs_following->fetch_assoc()) {
                    array_push($following, $fila_following['follows']);
                }
                $rs_following->free();
                $result = new UsuarioDTO($fila['username'], $fila['password'], $fila['email'], $fila['role'], $fila['id'], $followers, $following, $fila['profile_image']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM users WHERE id=%d", $idUsuario);
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $query_followers = "SELECT * FROM followers WHERE follows=?";
                $stmt_followers = $conn->prepare($query_followers);
                $stmt_followers->bind_param("s", $fila['id']);
                $stmt_followers->execute();
                $rs_followers = $stmt_followers->get_result();
                $followers = array();
                while ($fila_followers = $rs_followers->fetch_assoc()) {
                    array_push($followers, $fila_followers['user']);
                }
                $rs_followers->free();
                $query_following = "SELECT * FROM followers WHERE user=?";
                $stmt_following = $conn->prepare($query_following);
                $stmt_following->bind_param("s", $fila['id']);
                $stmt_following->execute();
                $rs_following = $stmt_following->get_result();
                $following = array();
                while ($fila_following = $rs_following->fetch_assoc()) {
                    array_push($following, $fila_following['follows']);
                }
                $rs_following->free();
                $result = new UsuarioDTO($fila['username'], $fila['password'], $fila['email'], $fila['role'], $fila['id'], $followers, $following, $fila['profile_image']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscaNombrePorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT username FROM users WHERE id=%d", $idUsuario);
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = $fila['username'];
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
    
    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
   
    private static function inserta(UsuarioDTO $usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();

        $checkQuery = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($checkQuery);
        $username = $usuario->getNombreUsuario();
        $email = $usuario->getEmail();
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return false; // User already exists
        } else {
            $insertQuery = "INSERT INTO users (username, email, password, role, profile_image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $password = $usuario->getPassword();
            $role = $usuario->getRole();
            $profile_image = $usuario->getProfileImage();
            $stmt->bind_param("sssis", $username, $email, $password, $role, $profile_image);
            if ($stmt->execute()) {
                $usuario->addId($stmt->insert_id);
                return $usuario;
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        } 
    }
    
    private static function actualiza(UsuarioDTO $usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "UPDATE users SET username = ?, email = ?, password = ?, profile_image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $nombreUsuario = $usuario->getNombreUsuario();
        $email = $usuario->getEmail();
        $profile_image = $usuario->getProfileImage();
        $password = $usuario->getPassword();
        $id = $usuario->getId();
        $stmt->bind_param("ssssi", $nombreUsuario, $email, $password, $profile_image, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }
   
    
    private static function borra(UsuarioDTO $usuario)
    {
        return self::borraPorId($usuario->getId());
    }
    
    private static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        }
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $idUsuario);
        if (!$stmt->execute()) {
            error_log("Error BD ({$stmt->errno}): {$stmt->error}");
            return false;
        }
        return true;
    }

    private static function guarda(UsuarioDTO $user)
    {
        if ($user->getId() !== null) {
            return self::actualiza($user);
        }
        return self::inserta($user);
    }

    public static function actualizaUsuario(UsuarioDTO $usuario)
    {
        return self::actualiza($usuario);
    }

    public static function seguirUsuario($nombreUsuario, $nombreUsuarioSeguir)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        $usuarioSeguir = self::buscaUsuario($nombreUsuarioSeguir);
        
        if ($usuario && $usuarioSeguir) {
            $usuarioId = $usuario->getId();
            $usuarioSeguirId = $usuarioSeguir->getId();
            $conn = Aplicacion::getInstance()->getConexionBd();
            if (in_array($usuarioSeguir->getId(), $usuario->getFollowing()) || $usuario->getId() == $usuarioSeguir->getId()) {
                echo "You are already following this user.";
                return false;
            }
            $query = "INSERT INTO followers (user, follows, since) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $date = date("Y-m-d H:i:s");
            $stmt->bind_param("iis", $usuarioId, $usuarioSeguirId, $date);
            
            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }
        
        return false;
    }

    public static function dejarDeSeguirUsuario($nombreUsuario, $nombreUsuarioSeguir)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        $usuarioSeguir = self::buscaUsuario($nombreUsuarioSeguir);
        
        if ($usuario && $usuarioSeguir) {
            $usuarioId = $usuario->getId();
            $usuarioSeguirId = $usuarioSeguir->getId();
            $conn = Aplicacion::getInstance()->getConexionBd();
            if (!in_array($usuarioSeguir->getId(), $usuario->getFollowing()) || $usuario->getId() == $usuarioSeguir->getId()) {
                echo "You are not following this user.";
                return false;
            }
            $query = "DELETE FROM followers WHERE user = ? AND follows = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $usuarioId, $usuarioSeguirId);
            
            if ($stmt->execute()) {
                return true;
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
                return false;
            }
        }
        
        return false;
    }

    public static function buscarUsuariosQueEmpiecenPor($term) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM users WHERE username LIKE ?";
        $stmt = $conn->prepare($query);
        $term = $term . "%";
        $stmt->bind_param("s", $term);
        $stmt->execute();
        $rs = $stmt->get_result();
        $result = array();
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                array_push($result, $fila['username']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function buscarSugerido($term)
{
    $conn = Aplicacion::getInstance()->getConexionBd();
    $query = "SELECT * FROM users WHERE username LIKE ?";
    $stmt = $conn->prepare($query);
    $term = $term . "%";
    $stmt->bind_param("s", $term);
    $stmt->execute();
    $rs = $stmt->get_result();
    $result = array();
    if ($rs) {
        while ($fila = $rs->fetch_assoc()) {
            if ($fila) {
                $query_followers = "SELECT * FROM followers WHERE follows=?";
                $stmt_followers = $conn->prepare($query_followers);
                $stmt_followers->bind_param("s", $fila['id']);
                $stmt_followers->execute();
                $rs_followers = $stmt_followers->get_result();
                $followers = array();
                while ($fila_followers = $rs_followers->fetch_assoc()) {
                    array_push($followers, $fila_followers['user']);
                }
                $rs_followers->free();
                
                $query_following = "SELECT * FROM followers WHERE user=?";
                $stmt_following = $conn->prepare($query_following);
                $stmt_following->bind_param("s", $fila['id']);
                $stmt_following->execute();
                $rs_following = $stmt_following->get_result();
                $following = array();
                while ($fila_following = $rs_following->fetch_assoc()) {
                    array_push($following, $fila_following['follows']);
                }
                $rs_following->free();
                
                array_push($result, new UsuarioDTO($fila['username'], $fila['password'], $fila['email'], $fila['role'], $fila['id'], $followers, $following, $fila['profile_image']));
            }
        }
        // Liberar el conjunto de resultados después de que hayas terminado de iterar
        $rs->free();
    } else {
        error_log("Error BD ({$conn->errno}): {$conn->error}");
    }
    return $result;
}

/*
Convierte a un usuario en moderador
*/
/*
Convierte a un usuario en moderador
*/
public static function promoverUsuario($id_usuario)
{
    $conn = Aplicacion::getInstance()->getConexionBd();
    $query = "UPDATE users SET role = 2 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_usuario);
    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
}

/*
Convierte a un moderador en un usuario común
*/
public static function degradarUsuario($id_usuario)
{
    $conn = Aplicacion::getInstance()->getConexionBd();
    $query = "UPDATE users SET role = 0 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_usuario);
    if ($stmt->execute()) {
        return true;
    } else {
        error_log("Error BD ({$conn->errno}): {$conn->error}");
        return false;
    }
}
public static function buscarEmail($email)
{
    $conn = Aplicacion::getInstance()->getConexionBd();
    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $rs = $stmt->get_result();

    if ($rs->num_rows > 0) {
        // El email existe en la base de datos
        return true;
    } else {
        // El email no existe en la base de datos
        return false;
    }
}

}

