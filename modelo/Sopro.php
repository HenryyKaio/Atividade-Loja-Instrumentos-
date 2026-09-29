<?php

require_once("Instrumento.php");
require_once("Palheta.php");

class Sopro extends Instrumento{

    private Palheta $palheta;
    private string $material;
    private string $familia;

    public function __construct($nome, $marca, $modelo, $preco, $qtd, $material, $familia, ?Palheta $palheta = null) {
        parent::__construct($nome, $marca, $modelo, $preco, $qtd);
        $this->material = $material;
        $this->familia = $familia;
        $this->palheta = $palheta;
    }


    public function getPalheta(): Palheta
    {
        return $this->palheta;
    }

    public function setPalheta(Palheta $palheta): self
    {
        $this->palheta = $palheta;

        return $this;
    }

    public function getMaterial(): string
    {
        return $this->material;
    }

    public function setMaterial(string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getFamilia(): string
    {
        return $this->familia;
    }

    public function setFamilia(string $familia): self
    {
        $this->familia = $familia;

        return $this;
    }
}
