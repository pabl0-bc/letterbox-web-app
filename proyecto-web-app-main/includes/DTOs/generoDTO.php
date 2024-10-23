<?php
class generoDTO
{
    public $genero;

    function __construct($genero)
    {
        $this->setGenero($genero);
    }
    protected function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getGenero()
    {
        return $this->genero;

    }
}