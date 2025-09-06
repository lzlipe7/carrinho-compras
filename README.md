# Sistema de Carrinho em PHP

## Integrantes da Dupla
- Nome: Alexsandher Angel - RA: 1986097  
- Nome: Luiz Felipe Rosa dos Santos - RA: 1996870  

## Sobre o Projeto
Trata-se de um sistema simples em PHP que simula o funcionamento de um carrinho de compras. Foi desenvolvido como exercício prático para aplicar conceitos de organização de código e boas práticas, sem uso de banco de dados ou frameworks. Os dados são todos mantidos em arrays.

## Como Executar
1. Baixe e instale o XAMPP e inicie o Apache.  
2. Coloque a pasta do projeto em `htdocs/carrinho`.  
3. Acesse pelo navegador: `http://localhost/carrinho/scr/index.php`.  
4. Também pode rodar pelo terminal: vá até `scr/` e execute `php index.php`.  

## Funcionalidades
- Adicionar produtos, verificando estoque e atualizando o carrinho.  
- Remover produtos, devolvendo estoque.  
- Mostrar lista de itens com subtotal e valor total.  
- Calcular valor final com opção de aplicar cupom de desconto (`DESCONTO10` dá 10%).  

## Regras Básicas
- O subtotal é calculado automaticamente (preço × quantidade).  
- Estoque é ajustado sempre que adiciona ou remove item.  
- Cupom só afeta o total final.  

## Limitações
- Não há persistência de dados (tudo fica em memória).  
- Não há interface gráfica, apenas execução no navegador ou CLI.  
- Projeto em PHP puro, sem frameworks ou banco de dados.  

## Casos de Teste
- **Adicionar item válido** → Produto é inserido e estoque reduzido.  
- **Adicionar acima do estoque** → Mensagem de erro, carrinho não muda.  
- **Remover item** → Produto some do carrinho e estoque é restaurado.  
- **Aplicar cupom** → Total final recebe desconto de 10%.  
