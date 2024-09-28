# Anotações durante o desenvolvimento do projeto

Foi excluido o Model padrão de usuário e as migrations padrões para 
mostrar que não é necessário utilizar

---------------------------------------------------------------------------------
## Seeds -> Alimenta o banco de dados

Comando para criar
```php artisan make:seeder UsersTableSeeder ```
Comando para executar   
```php artisan db:seed UsersTableSeeder ```

----------------------------------------------------------------------------------

## Middleware

Para cada página que o usuário desejar acessar é necessário que seja feita uma
autenticação, confirmando se o usuário existe e está logado (uma session que diz isso)
Para cada função no controller seria necessário uma verificação no ínicio de tudo,
o que tornaria muito repetitivo. 
Por isso os middlewares, que irão verificar antes de executar a função desejada.

Comando para criar   ```php artisan make:middleware UserIsLogged```

----------------------------------------------------------------------------------

## Crypt

Em vez de passar /edit/{{item->id}} , Laravel tem a própria ferramenta de encriptação
que está associada com uma KEY dentro do ambiente .ENV

Pode utilizar o método ```Crypt::encrypt('value');```

----------------------------------------------------------------------------------

## Services

Por exemplo, no lugar de cada método nós fizermos um bloco de try para tentar
descriptar o valor que queremos, podemos criar uma classe que irá servir para
nos auxiliarmos com esses métodos e será acessível por todos os Controllers.
Tratam de gerir a regra de négocio e deixar para que o controller seja responsável
por lidar apenas com a requisição -> resposta. Models, comunicação externa com API's, tudo seria feito por lá.