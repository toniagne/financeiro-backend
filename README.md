# GESTOR FINANCEIRO (BACK-END / API) PHP / Laravel 7

Projeto do desenvolvimento da API do módulo financeiro

# DETALHES DO PROJETO

Projeto focado no desenvolvimento da API do projeto contendo todos os end-points funcionais.

## MÉTODOS E TECNOLOGIAS UTILIZADAS

- [Linguagem PHP](https://www.php.net/)
- [Banco de dados MYSql](https://www.mysql.com/)
- [Framework Laravel 7.1](https://laravel.com/)

### INSTALAÇÃO
Clonagem do diretório:
```
git clone https://github.com/toniagne/financeiro-backend.git
```

Baixe as dependências do projeto via composer. 
```
composer update
```
Configure o autoload
```
composer dump-autoload
```
Baixar as dependências (na raiz do repositório):
```
Atualizar a estrutura do banco de dados  (na raiz do repositório):
```
php artisan migrate
```
Popular o banco de dados com dados para criar usuário de exemplo (login -> exemple@dev.com.br pass-> 123123 ) :
```
php artisan migrate --seed

# DESENVOLVEDOR

- Toni Reniê Schott Agne
