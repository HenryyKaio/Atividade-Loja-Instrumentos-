<?php

class Instrumento
{

    protected $preco;
    protected $nome;
    protected $marca;
    protected $modelo;
    protected $qtd;

    public function __construct($nome, $marca, $modelo, $preco, $qtd)
    {
        $this->nome = $nome;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->preco = $preco;
        $this->qtd = $qtd;
    }

    public function removerEstoque($qtd) {
        $this->qtd -= $qtd;
    }

    public function __toString()
    {
        $dados = $this->nome . $this->marca . $this->modelo . "\n";
        $dados .= " | Preço " . $this->preco . " | Quantidade: " . $this->qtd . "\n";
        return $dados;
    }

    public function CalcularTotal($carrinho)
    {
        $total = 0;
        foreach ($carrinho as $c) {
            $total += $c->getPreco();
        }

        return $total;
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

}