<?php


require_once("Instrumento.php");

class Corda extends Instrumento{

    private int $qtdCordas;
    private string $materialCorda;
    private int $qtdCaptadores;

    public function __construct($nome, $marca, $modelo, $preco, $qtd, $qtdCordas, $materialCorda, $qtdCaptadores) {
        parent::__construct($nome, $marca, $modelo, $preco, $qtd);
        $this->qtdCordas = $qtdCordas;
        $this->materialCorda = $materialCorda;
        $this->qtdCaptadores = $qtdCaptadores;
    }

    public function getQtdCordas(): int
    {
        return $this->qtdCordas;
    }

    public function setQtdCordas(int $qtdCordas): self
    {
        $this->qtdCordas = $qtdCordas;

        return $this;
    }

    public function getMaterialCorda(): string
    {
        return $this->materialCorda;
    }

    public function setMaterialCorda(string $materialCorda): self
    {
        $this->materialCorda = $materialCorda;

        return $this;
    }

    public function getQtdCaptadores(): int
    {
        return $this->qtdCaptadores;
    }

    public function setQtdCaptadores(int $qtdCaptadores): self
    {
        $this->qtdCaptadores = $qtdCaptadores;

        return $this;
    }
}