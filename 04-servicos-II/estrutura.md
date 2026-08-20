```
api-produtos/
├── config/
│   └── Database.php          # Conexão PDO com MySQL
├── src/
│   ├── DTOs/
│   │   ├── ProdutoCreateDTO.php   # Sanitização e validação da entrada
│   │   └── ProdutoResponseDTO.php # Formatação segura da saída JSON
│   ├── Models/
│   │   └── ProdutoModel.php       # Consultas SQL com PDO
│   └── Controllers/
│       └── ProdutoController.php  # Lógica de recebimento, verbos e respostas HTTP
└── index.php
```