<?php

declare(strict_types=1);

require_once 'Carrinho.php';

$carrinho = new Carrinho();

echo "<pre>";

echo "Teste 1: Adicionar produto ID=1, Qtd=2\n";
echo $carrinho->adicionar(1, 2) . "\n";
echo $carrinho->mostrar() . "\n\n";

echo "Adicionando produto ID=2, Qtd=1\n";
echo $carrinho->adicionar(2, 1) . "\n";
echo $carrinho->mostrar() . "\n\n";

echo "Teste 2: Adicionar produto ID=3, Qtd=10\n";
echo $carrinho->adicionar(3, 10) . "\n";
echo $carrinho->mostrar() . "\n\n";

echo "Teste 3: Remover produto ID=2\n";
echo $carrinho->remover(2) . "\n";
echo $carrinho->mostrar() . "\n\n";

echo "Teste 4: Total com cupom DESCONTO10\n";
$total = $carrinho->total('DESCONTO10');
echo "Total: R$ $total\n";

echo "</pre>";
