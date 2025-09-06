<?php

declare(strict_types=1);

class CarrinhoDeCompras
{
    private array $produtosDisponiveis;
    private array $itensSelecionados;

    public function __construct()
    {
        $this->produtosDisponiveis = [
            ['id' => 1, 'nome' => 'Camiseta',     'preco' => 59.90,  'estoque' => 10],
            ['id' => 2, 'nome' => 'Calça Jeans',  'preco' => 129.90, 'estoque' => 5],
            ['id' => 3, 'nome' => 'Tênis',        'preco' => 199.90, 'estoque' => 3],
        ];

        $this->itensSelecionados = [];
    }

    public function adicionarProduto(int $idProduto, int $quantidade): string
    {
        $produto = $this->buscarProduto($idProduto);
        if ($produto === null) {
            return "O produto com ID {$idProduto} não foi localizado.";
        }

        if ($quantidade > $produto['estoque']) {
            return "Não há quantidade suficiente em estoque para '{$produto['nome']}'. Estoque atual: {$produto['estoque']}.";
        }

        $itemNoCarrinho = $this->buscarItem($idProduto);
        if ($itemNoCarrinho !== null) {
            $itemNoCarrinho['quantidade'] += $quantidade;
            $itemNoCarrinho['subtotal'] = $itemNoCarrinho['quantidade'] * $produto['preco'];
        } else {
            $this->itensSelecionados[] = [
                'id_produto' => $idProduto,
                'quantidade' => $quantidade,
                'subtotal'   => $quantidade * $produto['preco'],
            ];
        }

        $produto['estoque'] -= $quantidade;
        $this->atualizarProduto($produto);

        return "Produto '{$produto['nome']}' incluído com sucesso (quantidade: {$quantidade}).";
    }

    public function removerProduto(int $idProduto): string
    {
        $item = $this->buscarItem($idProduto);
        if ($item === null) {
            return "O item com ID {$idProduto} não está presente no carrinho.";
        }

        $produto = $this->buscarProduto($idProduto);
        $produto['estoque'] += $item['quantidade'];
        $this->atualizarProduto($produto);

        $this->itensSelecionados = array_filter(
            $this->itensSelecionados,
            fn($i) => $i['id_produto'] !== $idProduto
        );

        return "O item de ID {$idProduto} foi removido do carrinho com êxito.";
    }

    public function exibirCarrinho(): string
    {
        if (empty($this->itensSelecionados)) {
            return "O carrinho encontra-se vazio.";
        }

        $saida = "Itens atualmente no carrinho:\n";
        $total = 0;

        foreach ($this->itensSelecionados as $item) {
            $produto = $this->buscarProduto($item['id_produto']);
            $saida .= "- {$produto['nome']} (ID: {$item['id_produto']}) | Quantidade: {$item['quantidade']} | Subtotal: R$ {$item['subtotal']}\n";
            $total += $item['subtotal'];
        }

        $saida .= "Valor total: R$ {$total}\n";
        return $saida;
    }

    public function calcularValorTotal(string $cupom = ''): float
    {
        $total = 0;
        foreach ($this->itensSelecionados as $item) {
            $total += $item['subtotal'];
        }

        if ($cupom === 'DESCONTO10') {
            $total *= 0.90; // Aplicação de 10% de desconto
        }

        return $total;
    }

    private function buscarProduto(int $id): ?array
    {
        foreach ($this->produtosDisponiveis as $produto) {
            if ($produto['id'] === $id) {
                return $produto;
            }
        }
        return null;
    }

    private function buscarItem(int $id): ?array
    {
        foreach ($this->itensSelecionados as &$item) {
            if ($item['id_produto'] === $id) {
                return $item;
            }
        }
        return null;
    }

    private function atualizarProduto(array $produtoAtualizado): void
    {
        foreach ($this->produtosDisponiveis as &$produto) {
            if ($produto['id'] === $produtoAtualizado['id']) {
                $produto = $produtoAtualizado;
                return;
            }
        }
    }
}
