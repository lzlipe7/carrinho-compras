# 🛒 Carrinho de Compras em PHP

**Disciplina:** Design Patterns & Clean Code  
**Projeto:** Simulador de Carrinho de Compras  
**Integrantes:**  
- Alexsandher Angel (RA:1986097)  
- Luiz Felipe Rosa (RA:1996870)  

---

## 🚀 Objetivo
Desenvolver um sistema simples em **PHP puro**, aplicando **PSR-12**, **KISS** e **DRY**, simulando o carrinho de compras de um e-commerce.

---

## ⚙️ Como rodar
1. Instale o XAMPP.
2. Copie a pasta do projeto para C:\xampp\htdocs\carrinho-compras (ou crie um alias no Apache).
3. Inicie o **Apache** no painel do XAMPP.
4. Acesse no navegador:
   http://localhost/carrinho-compras

---

## 📦 Funcionalidades
- **Adicionar item ao carrinho**
  - Valida produto e estoque, atualiza carrinho e reduz estoque.
- **Remover item do carrinho**
  - Valida item, remove e devolve estoque.
- **Listar itens**
  - Mostra quantidade, subtotal e total.
- **Calcular total**
  - Soma dos subtotais.
- **Cupom de desconto**
  - DESCONTO10 → 10% no total.

---

## 🧪 Casos de Uso
- **Adicionar válido**: id=1, qtd=2 → adiciona e atualiza estoque.
- **Além do estoque**: id=3, qtd=10 → erro "Estoque insuficiente".
- **Remover**: id=2 → remove e restaura estoque.
- **Aplicar cupom**: DESCONTO10 → total -10%.

---

## 📂 Estrutura
carrinho-compras/
 ├── src/         # Código PHP
 ├── docs/        # PRD & docs
 ├── README.md
 └── .gitignore

---

## 🔒 Limitações
- Sem banco de dados (apenas arrays).
- Sem login/usuário.
- Sem formulários (valores fixos no código).
- PHP puro (sem frameworks).

## 📝 Critérios de Avaliação
- PSR-12, DRY, KISS.
- Funcionalidades mínimas ok.
- Doc clara (README) e organização.
- Criatividade na apresentação.
