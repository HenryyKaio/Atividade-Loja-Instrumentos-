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
    echo "[1] Adicionar instrumento ao carrinho\n";
    echo "[2] Encomendar instrumento\n";
    echo "[3] Ver carrinho\n";
    echo "[4] Remover do carrinho\n";
    echo "[5] Pagar instrumento(s)\n";
    echo "[0] Sair\n";
    $opcao = readline();

    switch ($opcao) {
        case '1':
            echo "Temos alguns instrumentos no estoque da loja, mas se você quiser um que não temos, você pode encomendar ele\n";
            echo "O que temos disponível são esses: \n";
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


            break;

        case '2':
            $instrumento = new Instrumento;
            $instrumento->setNome(readline("Qual o nome do instrumento você deseja encomendar? "));
            $instrumento->setMarca(readline("De qual marca ele é? "));
            $instrumento->setModelo(readline("Qual é o modelo? "));
            $instrumento->setPreco(readline("Qual é o preço base dele?") * 1.25 + 100);
            $instrumento->setTipoSaida(readline("A saída é stereo ou mono? "));


            break;

        case '3':

            break;

        case '4':

            break;

        case '5':

            break;

        case '0':

            break;

        default:
            echo "Insira uma opção válida das opções acima por favor.\n";
            break;
    }
} while ($opcao != 0);
