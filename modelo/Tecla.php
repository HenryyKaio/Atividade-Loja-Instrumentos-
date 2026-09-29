<?php

require_once("Instrumento.php");

class Tecla extends Instrumento{

    private int $qtdTeclas;

    public function __construct($nome, $marca, $modelo, $preco, $qtd, $qtdTeclas) {
        parent::__construct($nome, $marca, $modelo, $preco, $qtd);
        $this->qtdTeclas = $qtdTeclas;
    }
    


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