# Módulo de votação do Sistema GURI - VOTO

## Pré requisitos:
* Última versão estável do Xampp(7.3.0 / PHP 7.3.0)

Ou

* Apache 2.4.37
* PHP 7.3.0
* MariaDB 10.1.37
* PHP 7.3.0
* phpMyAdmin 4.8.4


## Siga estes passos para executar o sistema Voto:

1. Clone o repositório na root server directory (diretorio htdocs ou www): 
```console
WhoAmI@wHOamI:~$ git clone https://github.com/LuizFritsch/sistemaVoto.git
```

2. Crie uma base de dados chamada 'vot', com codificação de caracteres em utf-8 e importe ou execute o arquivo vot.sql

2.1 Caso seu banco esteja com um usuário:senha que não sejam "root":"", crie ou altere o arquivo sistemaVoto/sistemaVoto/application/config/database.php com as informações de usuario que desejares.

3. Execute o apache

4. Acesse no navegador de sua preferencia: http://localhost/sistemaVoto/SistemaVoto/
(Já tem os usuarios 'renaro' com privilégios de moderador e rafael, marcus e jhonnatan cadastrados com privilégios de membros)
