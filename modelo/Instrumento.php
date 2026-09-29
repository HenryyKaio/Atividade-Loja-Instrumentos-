<?php

class Instrumento {

    protected float $preco;
    protected string $nome;
    protected string $marca;
    protected string $modelo;
    protected int $qtd;


    public function __toString()
    {
        $dados = $this->nome . $this->marca . $this->modelo . "\n";
        $dados .= " | Preço " . $this->preco . " | Quantidade: " . $this->qtd . "\n";
        return $dados;
    }

    public function CalcularTotal($carrinho){
        $total = 0;
        foreach($carrinho as $c){
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