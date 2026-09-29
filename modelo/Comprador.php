<?php 

class Comprador {

    private string $nome;
    private string $sobrenome;
    private float $saldo;


    public function __toString(){
        $dados = $this->nome . $this->sobrenome . "\n";
        $dados .= "Saldo: R$" . $this->saldo . "\n";
        return $dados;
    }

    


    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of sobrenome
     */
    public function getSobrenome(): string
    {
        return $this->sobrenome;
    }

    /**
     * Set the value of sobrenome
     */
    public function setSobrenome(string $sobrenome): self
    {
        $this->sobrenome = $sobrenome;

        return $this;
    }

    /**
     * Get the value of saldo
     */
    public function getSaldo(): float
    {
        return $this->saldo;
    }

    /**
     * Set the value of saldo
     */
    public function setSaldo(float $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }
}       