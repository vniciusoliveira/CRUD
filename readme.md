# Sistema CRUD de Usuários

Este projeto é um sistema de Cadastro, Edição e Exclusão de Usuários (CRUD) desenvolvido em PHP, utilizando MySQL como banco de dados. Ele permite a criação, atualização, visualização e exclusão de usuários em uma interface web simples e funcional.

## 📋 Funcionalidades

- **Cadastro de Usuários**: Interface para cadastrar novos usuários com nome, email, endereço e telefone.
- **Visualização de Usuários**: Lista todos os usuários cadastrados, com opção de editar ou excluir.
- **Edição de Usuários**: Permite a atualização dos dados de um usuário existente.
- **Exclusão de Usuários**: Remove um usuário da base de dados.

## 📁 Estrutura de Arquivos

- `index.php`: Página principal de boas-vindas com links para cadastro e visualização de usuários.
- `register.php`: Página de formulário para cadastrar novos usuários.
- `edit.php`: Página para editar informações dos usuários.
- `users.php`: Página que exibe a lista de usuários cadastrados, com opções de editar e excluir.
- `includes/db.php`: Arquivo de configuração de banco de dados.
- `css/`: Pasta contendo arquivos de estilo para cada página.

## 🔧 Requisitos

- **PHP**: Versão 7.0 ou superior.
- **MySQL**: Um servidor MySQL para armazenar os dados dos usuários.
- **Servidor Local**: Como XAMPP, WAMP, ou outro ambiente com suporte a PHP e MySQL.

## 🚀 Configuração e Instalação

1. **Clone o repositório**:

   ```bash
   git clone https://github.com/vniciusoliveira/CRUD.git

2. **Configuração do Banco de Dados**:

Crie um banco de dados MySQL chamado `formulario`.
O sistema cria automaticamente a tabela usuarios se ela ainda não existir.

3. **Configuração do Arquivo** `db.php`:

Certifique-se de que o arquivo `db.php` possui as configurações corretas de conexão com o banco de dados:

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "formulario";

4. **Executando o Projeto**:

Coloque o projeto no diretório raiz do seu servidor local (ex.: htdocs para XAMPP).
Acesse http://localhost/nome-do-projeto no navegador para utilizar o sistema.

## 🗄️ Estrutura de Banco de Dados

A tabela `usuarios` é composta pelos seguintes campos:

- `id`: INT(11), chave primária e auto-incremento.
- `nome`: VARCHAR(100), obrigatório.
- `email`: VARCHAR(100), obrigatório.
- `endereco`: VARCHAR(150), opcional.
- `telefone`: VARCHAR(15), opcional.

## 📌 Uso

- **Cadastrar Usuário**: Na página inicial, clique em "Cadastrar Novo Usuário" e preencha o formulário.
- **Ver Usuários**: Acesse "Ver Usuários Cadastrados" para visualizar a lista completa.
- **Editar Usuário**: Clique no botão "Editar" ao lado do usuário que deseja atualizar.
- **Excluir Usuário**: Clique em "Excluir" para remover o usuário da base de dados.

## 📝 Observações

- A criação do banco de dados e da tabela ocorre automaticamente se ainda não existirem.
- Há validação para evitar a inserção de emails duplicados e campos obrigatórios não preenchidos.

