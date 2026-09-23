<?php

require_once("Instrumento.php");

class Tecla extends Instrumento{

    private int $qtdTeclas;

    


    public function getQtdTeclas(): int
    {
        return $this->qtdTeclas;
    }

    public function setQtdTeclas(int $qtdTeclas): self
    {
        $this->qtdTeclas = $qtdTeclas;

        return $this;
    }
}