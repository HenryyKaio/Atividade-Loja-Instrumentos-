<?php

class Palheta
{
    private $marca;
    private $tamanho;
    private $tipo;

    public function __construct($marca, $tamanho, $tipo)
    {
        $this->marca = $marca;
        $this->tamanho = $tamanho;
        $this->tipo = $tipo;
    }

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getTamanho(): int
    {
        return $this->tamanho;
    }

    public function setTamanho(int $tamanho): self
    {
        $this->tamanho = $tamanho;

        return $this;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}