<?php

class Instrumento {

    protected float $preco;
    protected string $nome;
    protected string $marca;
    protected string $modelo;
    protected string $tipoSaida;

    public function Testar(){

    }

    public function __toString()
    {
        
    }
    

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        $this->preco = $preco;

        return $this;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
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

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getTipoSaida(): string
    {
        return $this->tipoSaida;
    }

    public function setTipoSaida(string $tipoSaida): self
    {
        $this->tipoSaida = $tipoSaida;

        return $this;
    }
}