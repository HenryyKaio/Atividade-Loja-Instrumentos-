<?php

require_once("modelo/Tecla.php");
require_once("modelo/Corda.php");
require_once("modelo/Sopro.php");
require_once("modelo/Comprador.php");

$instrumentos = [
    "Teclas" => [
        new Tecla("Piano", "Yamaha", "U1", 15000.00, 3, 88),
        new Tecla("Órgão", "Hammond", "B3", 22000.00, 1, 61),
        new Tecla("Sintetizador", "Moog", "Sub 37", 8500.00, 5, 37)
    ],
    "Cordas" => [
        new Corda("Violão", "Taylor", "214ce", 4500.00, 10, 6, "Aço", 0),
        new Corda("Guitarra", "Fender", "Stratocaster", 7000.00, 4, 6, "Níquel", 3),
        new Corda("Violino", "Stradivarius", "Messiah", 50000.00, 1, 4, "Tripa", 0),
        new Corda("Violoncelo", "Cremona", "SC-165", 6000.00, 2, 4, "Aço", 0)
    ],
    "Sopro" => [
        new Sopro("Flauta", "Yamaha", "YFL-222", 3500.00, 6, "Prata", "Madeiras", null),
        new Sopro("Saxofone", "Selmer", "Mark VI", 18000.00, 2, "Latão", "Madeiras", new Palheta("Vandoren", "2.5", "Cana")),
        new Sopro("Trompete", "Bach", "Stradivarius 180S37", 12000.00, 3, "Metal", "Metais", null)
    ]
];

$carrinho = array();
$cadastroFeito = false;
$cliente = "";


echo "Bem vindo ao sistema automatizado da nossa loja!\n";
echo "O que você deseja fazer por aqui hoje?\n";

$opcao = 0;
do {
    echo "[1] Realizar Cadastro\n";
    echo "[2] Adicionar instrumento ao carrinho\n";
    echo "[3] Encomendar instrumento\n";
    echo "[4] Ver carrinho\n";
    echo "[5] Remover do carrinho\n";
    echo "[6] Pagar instrumento(s)\n";
    echo "[7] Ver saldo disponível\n";
    echo "[0] Sair\n";
    $opcao = readline();

    switch ($opcao) {


        case '1':
            if ($cadastroFeito == false) {
                $cliente = new Comprador();
                $cliente->setNome(readline("Qual é o seu nome? "));
                $cliente->setSaldo(readline("Qual é o seu saldo? "));
                echo "Seu cadastro foi feito com sucesso!\n";
                $cadastroFeito = true;
            } else {
                echo "Você já possui um cadastro!\n";
            }

            break;


        case '2':
            if($cadastroFeito == false) {
                echo "Você precisa fazer um cadastro primeiro!\n";
            } else {
                echo "Temos alguns instrumentos no estoque da loja, mas se você quiser um que não temos, você pode encomendar ele\n";
                echo "O que temos disponível são esses:              \n";
                echo "========================================\n";
                echo "       MENU DE INSTRUMENTOS MUSICAIS    \n";
                echo "========================================\n\n";
    
                foreach ($instrumentos as $categoria => $lista) {
                    echo "--- Categoria: {$categoria} ---\n";
                    foreach ($lista as $instrumento) {
                        $nome = $instrumento->getNome();
                        $marca = $instrumento->getMarca();
                        $modelo = $instrumento->getModelo();
                        $preco = number_format($instrumento->getPreco(), 2, ',', '.');
                        $qtd = $instrumento->getQtd();
    
                        echo " {$nome} | Marca: {$marca} | Modelo: {$modelo} | Preço: R$ {$preco} | Estoque: {$qtd}\n";
                    }
                    echo "\n";
                }
    
                echo "========================================\n";
                echo "Qual você quer? (se prefere encomendar algum digite 0): \n";
                $escolhaInst = readline();
                echo "Quantos você quer?\n";
                $qtdInst = readline();
                $instrumentoEncontrado = buscarEAtualizarEstoque($instrumentos, $escolhaInst, $qtdInst);
                if ($instrumentoEncontrado) {
                    adicionarAoCarrinho($carrinho, $instrumentoEncontrado, $qtdInst);
                }
            }
            break;

        case '3':
            $nome = readline("Qual o nome do instrumento você deseja encomendar? ");
            $marca = readline("De qual marca ele é? ");
            $modelo = readline("Qual é o modelo? ");
            $preco = (readline("Qual é o preço base dele?") * 1.25 + 100);
            $qtd = readline("Quantos você quer comprar?");
            $instrumento = new Instrumento($nome, $marca, $modelo, $preco, $qtd);
            echo "Pronto, seu instrumento foi encomendado e adicionado ao carrinho\n";
            if ($cliente->getSaldo() < $preco) {
                echo "Você não tem saldo suficiente para esse pedido\n";
            } else {
               adicionarAoCarrinho($carrinho, $instrumento, $qtd);
            }


            break;

        case '4':
            $i = 1;
        foreach ($carrinho as $dados) {
            $inst = $dados['item'];
            $qtd = $dados['quantidade'];
            echo $cliente->getNome() . " " . " | Compra Nº " . $i . " - " . $qtd . "x " . $inst->getNome() . " (" . $inst->getMarca() . " " . $inst->getModelo() . ") - R$ " . number_format($inst->getPreco(), 2, ',', '.') . "\n";
            $i++;
        }
            break;

        case '5':
            $indiceRemov = readline("Qual é o número da compra que você deseja remover do carrinho? ");
            array_splice($carrinho, $indiceRemov-1, 1);
            echo "Compra removida com sucesso!\n";
            break;

        case '6':
            echo "Muito bem! Vamos finalizar as compras.\n";
            $totalGasto = CalcularTotal($carrinho);
            echo "Suas compras deram um total de R$" . $totalGasto . "\n";
            if ($cliente->getSaldo() < $totalGasto) {
                echo "Você não tem saldo o suficiente para comprar tudo. Por favor remova algum item da lista.\n";
            } else {
                echo "Finalizando a compra";
                for ($i = 0; $i < 4; $i++) {
                    echo ".";
                    sleep(0.5);
                }
                echo "\nCompra realizada com sucesso! Volte sempre!\n";
                $opcao = 0;
            }
            break;

        case '7':
            $totalGasto = CalcularTotal($carrinho);
            $saldoDisponivel = $cliente->getSaldo() - $totalGasto;
            echo $cliente->getNome() . "\nSaldo disponível: " . $saldoDisponivel;
            echo "\nO total gasto no seu carrinho é " . $totalGasto . "\n";
            break;


        case '0':
            echo "Volte sempre!";
            break;

        default:
            echo "Insira uma opção válida das opções acima por favor.\n";
            break;
    }
} while ($opcao != 0);

function buscarEAtualizarEstoque(&$instrumentos, $escolhaInst, $qtdInst)
{
    foreach ($instrumentos as $categoria => $lista) {
        foreach ($lista as $i => $instrumento) {
            // Professor utilizei essa função que compara duas strings ignorando maiusculas ou minúsculas, ela retorna 0 se for verdadeiro
            // Então se o if for === 0, isto é, o valor e o tipo de dado igual, ele segue com o que está dentro
            if (strcasecmp($instrumento->getNome(), $escolhaInst) === 0) {
                if ($instrumento->getQtd() >= $qtdInst) {
                    $instrumento->removerEstoque($qtdInst);
                    return $instrumento;
                } else {
                    echo "Estoque insuficiente para " . $escolhaInst . ". Disponível: " . $instrumento->getQtd() . "\n";
                    return null;
                }
            }
        }
    }

    echo "Instrumento " . $escolhaInst . " não encontrado!\n";
    return null;
}

function adicionarAoCarrinho(&$carrinho, $instrumento, $qtdInst = 1)
{
    $nome = $instrumento->getNome();

    if (isset($carrinho[$nome])) {
        $carrinho[$nome]['quantidade'] += $qtdInst;
    } else {
        $carrinho[$nome] = [
            'item' => $instrumento,
            'quantidade' => $qtdInst
        ];
    }
}

function CalcularTotal($carrinho)
    {
        $totalGeral = 0;

        foreach ($carrinho as $dados) {
            $instrumento = $dados['item'];
            $quantidade = $dados['quantidade'];
            $subtotal = $instrumento->getPreco() * $quantidade;
            $totalGeral += $subtotal;
        }

        return $totalGeral;
    }

