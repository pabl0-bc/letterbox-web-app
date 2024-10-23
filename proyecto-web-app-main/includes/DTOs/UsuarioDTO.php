<?php

class UsuarioDTO {
    private $id;

    private $nombreUsuario;

    private $password;

    private $email;

    private $role;

    private $followers = [];

    private $following = [];

    private $profile_image;

    public function __construct($nombreUsuario, $password, $email, $role = 0, $id = null, $followers = [], $following = [], $profile_image = null)
    {
        $this->setUser($nombreUsuario, $password, $email, $role, $id, $followers, $following, $profile_image);
    }

    private function setUser($nombreUsuario, $password, $email, $role = 0, $id = null, $followers = [], $following = [], $profile_image = null) {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->followers = $followers;
        $this->following = $following;
        $this->profile_image = $profile_image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getFollowers()
    {
        return $this->followers;
    }

    public function getFollowing()
    {
        return $this->following;
    }

    public function getProfileImage()
    {
        return $this->profile_image;
    }

    public function setProfileImage($profile_image)
    {
        $this->profile_image = $profile_image;
    }

    public function compruebaPassword($password)
    {  
        $password_check = password_verify($password, $this->password);
        return $password_check;
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = password_hash($nuevoPassword, PASSWORD_DEFAULT);
    }
    
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }

    public function addId ($id) {
        if ($this->id === null) {
            $this->id = $id;
        }
    }
}
