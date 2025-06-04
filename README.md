# 📚 Biblioteca API – Sistema de Gerenciamento de Biblioteca

Este é um sistema de gerenciamento de biblioteca desenvolvido em **Laravel**, que permite:

- Cadastro e gerenciamento de usuários
- Cadastro e organização de livros por gênero
- Controle de empréstimos com datas de devolução e status (Emprestado, Atrasado, Devolvido)

---

## 🚀 Tecnologias Utilizadas

- [Laravel 10+](https://laravel.com/)
- PHP 8.1+
- MySQL 5.7/8.0
- Composer
- Insomnia (para testes de API)

---

## 📁 Estrutura da API

- `User` – Nome, Email, Número de Cadastro
- `Book` – Título, Autor, Número de Registro, Situação (Disponível ou Emprestado), Gênero
- `Genre` – Nome do Gênero (Ficção, Romance, etc.)
- `Loan` – Relação entre Usuário e Livro, com data de devolução e status

---

## ⚙️ Instalação e Configuração

### Pré-requisitos

- PHP 8.1+
- Composer
- MySQL
- Git

### Passos

1. Clone o repositório:
   ```bash
   git clone https://github.com/PedroHenr1que1/Interview.git
2. Instale as dependências:
   ```bash
   composer install
3. Configure o arquivo .env com suas credenciais do banco de dados:
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=biblioteca
   DB_USERNAME=root
   DB_PASSWORD=suasenha
4. Crie o banco de dados biblioteca no MySQL:
   ```bash
   CREATE DATABASE biblioteca;
5. Rode as migrations e seeders:
   ```bash
   php artisan migrate:fresh --seed
6. Inicie o servidor:
   ```bash
   php artisan serve

A API estará disponível em:
📍 http://localhost:8000/api


## 🔁 Endpoints da API

### 🧑‍💼 Usuários
- GET /api/users

- GET /api/users/{id}

- POST /api/users

- PUT /api/users/{id}

- DELETE /api/users/{id}

### 📚 Livros
- GET /api/books

- GET /api/books/{id}

- POST /api/books

- PUT /api/books/{id}

- DELETE /api/books/{id}

### 🏷️ Gêneros
- GET /api/genres

- GET /api/genres/{id}

- POST /api/genres

- PUT /api/genres/{id}

- DELETE /api/genres/{id}

### 📖 Empréstimos
- GET /api/loans

- GET /api/loans/{id}

- POST /api/loans

- PUT /api/loans/{id} (Devolvido/Atrasado)

- DELETE /api/loans/{id}

## 🔐 Regras de Negócio
1. Livro só pode ser emprestado se estiver Disponível
2. Ao emprestar, o status muda para Emprestado
3. Ao devolver, o status do empréstimo vira Devolvido e o livro volta a Disponível

## 🧪 Testes com Insomnia
Abra o Insomnia

Vá em Import → From File

Selecione o arquivo insomnia.json

A base da API será http://localhost:8000/api

## 🗂 Estrutura de Pastas Essenciais

```bash
biblioteca/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── BookController.php
│   │       ├── Controller.php
│   │       ├── GenreController.php
│   │       ├── LoanController.php
│   │       └── UserController.php
│   ├── Models/
│   │   ├── Book.php
│   │   ├── Genre.php
│   │   ├── Loan.php
│   │   └── User.php
│   └── Providers/
│       └── AppServiceProvider.php
│
├── bootstrap/
│   └── app.php
│
├── config/
│   └── (arquivos de configuração do Laravel)
│
├── database/
│   ├── migrations/
│   │   ├── 2025_05_30_164520_create_genres_table.php
│   │   ├── 2025_05_30_164727_create_books_table.php
│   │   ├── 2025_05_30_164800_create_users_table.php
│   │   └── 2025_05_30_164827_create_loans_table.php
│   ├── seeders/
│   │   ├── BookSeeder.php
│   │   ├── DatabaseSeeder.php
│   │   ├── GenreSeeder.php
│   │   └── UserSeeder.php
│   └── database.sqlite 
│
├── routes/
│   └── api.php
│
├── insomnia/
│   └── Insomnia.json (collection para testar a API)
│
├── .env
├── .env.example
├── .gitignore
├── composer.json
├── composer.lock
├── artisan
└── README.md
```

## 👨‍💻 Autor
Desenvolvido por Pedro Henrique Faria Almeida

Email: Pedrohenriquefaria9@gmail.com

Teste para Desenvolvedor Backend 
