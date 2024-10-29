# Documentação da API

Esta API foi desenvolvida em Laravel 11.x para gerenciar consultas, uploads de arquivos, registrar históricos do Desafio Oliveira.

### Autenticação

A API utiliza [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum) para autenticação. Você precisa fornecer um token de autenticação no cabeçalho de cada requisição.

Para gerar seu token de autenticação é necessário enviar uma requisição via post.

```bash
  curl --location 'http://127.0.0.1:8000/api/login' \
--header 'Accept: application/json' \
--form 'email="Seu e-mail"' \
--form 'password="Sua Senha"'
```

### Response

```json
{
    "status": true,
    "token": "Token Gerado",
    "user": {
        "id": 1,
        "name": "Seu Nome",
        "email": "Seu e-mail',
        "email_verified_at": null,
        "created_at": "2024-10-28T08:03:18.000000Z",
        "updated_at": "2024-10-28T08:03:18.000000Z"
    }
}
```

**Cabeçalho de Autenticação:**

