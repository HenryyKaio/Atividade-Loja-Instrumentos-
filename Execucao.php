<?php

require_once("modelo/Tecla.php");
require_once("modelo/Corda.php");
require_once("modelo/Sopro.php");

$instrumentos = [
    "Teclas" => [
        ["nome" => "Piano", "marca" => "Yamaha", "modelo" => "U1"],
        ["nome" => "Órgão", "marca" => "Hammond", "modelo" => "B3"],
        ["nome" => "Sintetizador", "marca" => "Moog", "modelo" => "Sub 37"]
    ],
    "Cordas" => [
        ["nome" => "Violão", "marca" => "Taylor", "modelo" => "214ce"],
        ["nome" => "Guitarra", "marca" => "Fender", "modelo" => "Stratocaster"],
        ["nome" => "Violino", "marca" => "Stradivarius", "modelo" => "Messiah"],
        ["nome" => "Violoncelo", "marca" => "Cremona", "modelo" => "SC-165"]
    ],
    "Sopro" => [
        ["nome" => "Flauta", "marca" => "Yamaha", "modelo" => "YFL-222"],
        ["nome" => "Saxofone", "marca" => "Selmer", "modelo" => "Mark VI"],
        ["nome" => "Trompete", "marca" => "Bach", "modelo" => "Stradivarius 180S37"]
    ]
];

$carrinho = array();

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
    echo "[0] Sair\n";
    $opcao = readline();

    switch ($opcao) {


        case '1':
            $cliente = new Comprador;
            $clinte->setNome(readline("Qual é o seu primeiro nome? "));
            $cliente->setSobrenome(readline("Qual é o seu sobrenome? "));
            echo "Cadastro realizado com sucesso! \n";
            break;


        case '2':
            echo "Temos alguns instrumentos no estoque da loja, mas se você quiser um que não temos, você pode encomendar ele\n";
            echo "O que temos disponível são esses:                                                                            $cliente\n";
            echo "========================================================\n";
            echo "                 MENU DE INSTRUMENTOS                   \n";
            echo "========================================================\n";

            $numero = 1;

            foreach ($instrumentos as $categoria => $lista) {
                echo "\n--- $categoria ---\n";
                foreach ($lista as $item) {
                    echo sprintf(
                        "  [%2d] %-13s | Marca: %-12s | Modelo: %s\n",
                        $numero,
                        $item['nome'],
                        $item['marca'],
                        $item['modelo']
                    );
                    $numero++;
                }
            }

            echo "\n========================================================\n";
            echo "Qual você quer? (se prefere encomendar algum digite 0): \n";
            $escolha = readline();
            if($escolha > 0 and $escolha < 4) {
                $teclado = new Tecla;

            } else if($escolha < 8 and $escolha > 3){

            } else if($escolha < 11 and $escolha > 7) {
                echo "Você deseja comprar uma palheta também? \n";
            }


            break;

        case '3':
            $instrumento = new Instrumento;
            $instrumento->setNome(readline("Qual o nome do instrumento você deseja encomendar? "));
            $instrumento->setMarca(readline("De qual marca ele é? "));
            $instrumento->setModelo(readline("Qual é o modelo? "));
            $instrumento->setPreco(readline("Qual é o preço base dele?") * 1.25 + 100);
            echo "Pronto, seu instrumento foi encomendado e adicionado ao carrinho\n";

            array_push($carrinho, $instrumento);


            break;

        case '4':
            foreach ($carrinho as $i => $inst) {
                echo "$cliente->getNome()" . "$cliente->getSobrenome()" . " compra Nº: $i+=1: $inst\n";
            }
            break;

        case '5':
            $indiceRemov = readline("Qual é o número da compra que você deseja remover do carrinho? ");
            array_splice($carrinho, $indiceRemov, 1);
            echo "Compra removida com sucesso!\n";
            break;

        case '6':
            echo "Muito bem! Vamos finalizar as compras.\n";
            echo "Suas compras deram um total de R$$instrumento->CalcularTotal($carrinho)\n";
            if ($cliente->getSaldo() < $instrumento->CalcularTotal($carrinho)) {
                echo "Você não tem saldo o suficiente para comprar tudo. Por favor remova algum item da lista.\n";
            } else {
                echo "Finalizando a compra";
                for ($i = 0; $i < 4; $i++) {
                    echo ".";
                    sleep(0.5);
                }
                echo "\nCompra realizada com sucesso! Volte sempre!\n";
            }
            break;


        case '0':
            echo "Volte sempre!";
            break;

        default:
            echo "Insira uma opção válida das opções acima por favor.\n";
            break;
    }
} while ($opcao != 0);
