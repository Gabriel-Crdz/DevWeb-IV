## API REST de Produtos

### Contexto: 

Uma loja de informática precisa de uma API interna para gerenciar o seu catálogo de produtos. A equipe de front-end precisa que você crie o módulo de produtos seguindo a mesma arquitetura em camadas que aprendemos nas aulas anteriores.

### Sua missão:

1. Criar a tabela `produtos` no MySQL (id, nome, preco, estoque).
2. Criar a classe `ProdutoDTO.php` contendo apenas id, nome e preco (ocultando o campo interno de estoque na resposta do cadastro).
3. Criar a classe `ProdutoService.php` com as regras de negócio:
    - O preço precisa ser maior que zero.
    - O nome não pode estar em branco.
6. Criar o controller produtos.php (API REST) que suporte:
    - **POST:** Cadastra um novo produto (recebe JSON, valida no serviço e retorna o DTO com Status HTTP 201).
    - **GET:** Lista todos os produtos cadastrados com Status HTTP 200.
7. Testar os dois cenários no Hoppscotch.