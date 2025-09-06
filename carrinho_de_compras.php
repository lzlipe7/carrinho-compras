<?php

declare(strict_types=1);

class Carrinho
{
    private array $produtos;
    private array $itens;

    public function __construct()
    {
        $this->produtos = [
            ['id' => 1, 'nome' => 'Camiseta', 'preco' => 59.90, 'estoque' => 10],
            ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
            ['id' => 3, 'nome' => 'Tênis', 'preco' => 199.90, 'estoque' => 3],
        ];

        $this->itens = [];
    }

    public function adicionar(int $id, int $qtd): string
    {
        $produto = $this->buscarProduto($id);
        if (!$produto) {
            return "Produto $id não existe.";
        }

        if ($qtd > $produto['estoque']) {
            return "Sem estoque de {$produto['nome']} (disponível: {$produto['estoque']}).";
        }

        foreach ($this->itens as &$item) {
            if ($item['id'] === $id) {
                $item['qtd'] += $qtd;
                $item['subtotal'] = $item['qtd'] * $produto['preco'];
                $this->reduzirEstoque($id, $qtd);
                return "{$produto['nome']} adicionado (Qtd: $qtd).";
            }
        }

        $this->itens[] = [
            'id' => $id,
            'qtd' => $qtd,
            'subtotal' => $qtd * $produto['preco']
        ];
        $this->reduzirEstoque($id, $qtd);

        return "{$produto['nome']} adicionado (Qtd: $qtd).";
    }

    public function remover(int $id): string
    {
        foreach ($this->itens as $key => $item) {
            if ($item['id'] === $id) {
                $this->devolverEstoque($id, $item['qtd']);
                unset($this->itens[$key]);
                return "Item $id removido.";
            }
        }
        return "Item $id não está no carrinho.";
    }

    public function mostrar(): string
    {
        if (empty($this->itens)) {
            return "Carrinho vazio.";
        }

        $texto = "Itens no carrinho:\n";
        $total = 0;
        foreach ($this->itens as $item) {
            $produto = $this->buscarProduto($item['id']);
            $texto .= "- {$produto['nome']} (ID: {$item['id']}) | Qtd: {$item['qtd']} | Subtotal: R$ {$item['subtotal']}\n";
            $total += $item['subtotal'];
        }
        $texto .= "Total: R$ $total\n";
        return $texto;
    }

    public function total(string $cupom = ''): float
    {
        $valor = 0;
        foreach ($this->itens as $item) {
            $valor += $item['subtotal'];
        }

        if ($cupom === 'DESCONTO10') {
            $valor *= 0.9;
        }

        return $valor;
    }

    private function buscarProduto(int $id): ?array
    {
        foreach ($this->produtos as $p) {
            if ($p['id'] === $id) {
                return $p;
            }
        }
        return null;
    }

    private function reduzirEstoque(int $id, int $qtd): void
    {
        foreach ($this->produtos as &$p) {
            if ($p['id'] === $id) {
                $p['estoque'] -= $qtd;
            }
        }
    }

    private function devolverEstoque(int $id, int $qtd): void
    {
        foreach ($this->produtos as &$p) {
            if ($p['id'] === $id) {
                $p['estoque'] += $qtd;
            }
        }
    }
}
