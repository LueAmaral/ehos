# Ehos - Sistema de Gerenciamento de Usuários

## Descrição

Este é um sistema simples de gerenciamento de usuários com funcionalidades de login, cadastro, edição e exclusão de usuários. Ele foi desenvolvido utilizando PHP e MySQL.

## Funcionalidades

- Cadastro de Usuários
- Login de Usuários
- Logout
- Edição de Usuários
- Exclusão de Usuários
- Listagem de Usuários (Apenas para administradores)

## Instalação

### Requisitos

- PHP >= 7.4
- MySQL >= 5.7
- Servidor Web (Apache, Nginx, etc.)

### Passos para Instalação

1. Clone o repositório:

    ```bash
    git clone https://github.com/LueAmaral/ehos.git
    cd ehos
    ```

2. Configure o banco de dados:

    - Crie um banco de dados no MySQL.
    - Execute o script SQL (`schema.sql`) para criar as tabelas e inserir dados iniciais.

3. Configure a conexão com o banco de dados:

    - Edite o arquivo `db.php` e insira as credenciais do banco.

4. Inicie o servidor web e acesse a aplicação pelo navegador.

5. Acesse o site e faça o login com o usuário administrador criado no script SQL.

## Autor

Lue Rodrigues do Amaral - [lue.amaral@etec.sp.gov.br](mailto:lue.amaral@etec.sp.gov.br)
