<?php

require_once("modelo/Tecla.php");
require_once("modelo/Corda.php");
require_once("modelo/Sopro.php");

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
            echo "O que temos disponível são esses:                                                                        " . $cliente . "\n";
            echo "========================================\n";
            echo "       MENU DE INSTRUMENTOS MUSICAIS    \n";
            echo "========================================\n\n";

            $contador = 1;

            foreach ($instrumentosObj as $categoria => $lista) {
                echo "--- Categoria: {$categoria} ---\n";

                foreach ($lista as $instrumento) {
                    // Exibindo SOMENTE os atributos herdados de Instrumento
                    $nome = $instrumento->getNome();
                    $marca = $instrumento->getMarca();
                    $modelo = $instrumento->getModelo();
                    $preco = number_format($instrumento->getPreco(), 2, ',', '.');
                    $qtd = $instrumento->getQtd();

                    echo "[$contador] {$nome} | Marca: {$marca} | Modelo: {$modelo} | Preço: R$ {$preco} | Estoque: {$qtd}\n";

                    $contador++;
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





            break;

        case '3':
            $nome = readline("Qual o nome do instrumento você deseja encomendar? ");
            $marca = readline("De qual marca ele é? ");
            $modelo = readline("Qual é o modelo? ");
            $preco = (readline("Qual é o preço base dele?") * 1.25 + 100);
            $qtd = readline("Quantos você quer comprar?");
            $instrumento = new Instrumento($nome, $marca, $modelo, $preco, $qtd);
            echo "Pronto, seu instrumento foi encomendado e adicionado ao carrinho\n";
            if($saldo < $preco) {
                echo "Você não tem saldo suficiente para esse pedido\n";
            } else {
                array_push($carrinho, $instrumento);
            }


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
            echo "Suas compras deram um total de R$" . $instrumento->CalcularTotal($carrinho) . "\n";
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

function buscarEAtualizarEstoque($instrumentos, $escolhaInst, $qtdInst)
{
    foreach ($instrumentos as $categoria => $lista) {
        foreach ($lista as $i => $instrumento) {
            // Professor utilizei essa função que compara duas strings ignorando maiusculas ou minúsculas, ela retorna 0 se for verdadeiro
            // Então se o if for === 0, isto é, o valor e o tipo de dado igual, ele segue com o que está dentro
            if (strcasecmp($instrumento->getNome(), $escolhaInst)) {
                if ($instrumento->getQtd() <= $qtdInst) {
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

function adicionarAoCarrinho($carrinho, $instrumento, $qtdInst = 1)
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
