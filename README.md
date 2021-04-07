# Instalação
1. Rode o comando ``composer install`` para instalar as dependencias do projeto.
2. No terminal digite `cp .env.example .env` para criar o .env , ou copie e cole env.example e a renomeie.
3. Rode o comando ``php artisan key:generate`` , para gerar uma chave para aplicação no .env .
4. No arquivo .env , das variaveis com nome **DB** , insira as configurações do banco que será utilizado pela aplicação.
5. Rode o comando ``php artisan migrate`` , para migrar para as tabelas que serão utilizadas pela aplicação , para seu banco.
6. Rode o comando `` npm install ``, para instalar as dependencias no projeto.
7. Rode o comando ``npm run dev `` , para compilar os assets na aplicação.

# Utilização
1. Rode o comando ``php artisan serve`` , para utilizar a aplicação localmente.


### Enjoy :)
