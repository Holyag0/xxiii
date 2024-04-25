# xxiii 
começo do projeto
centro de formação de condutores (cfc)


## Pré-requisitos

Antes de começar, certifique-se de ter o seguinte instalado no docker ou laravel-sail:
- PHP 8.0=>
- Composer
- Node.js
- NPM
- mysql
- nginx (opcional)

## Instalação

Primeiro, clone o repositório para a sua máquina local:

bash
```git clone <url-do-seu-repositório>```

Instale as dependências do PHP com o Composer:
```composer install```

nstale as dependências do Node.js com o NPM:
```npm install```

Execução
Depois de instalar todas as dependências, você pode configurar o banco de dados executando as migrações do Laravel:

```php artisan migrate```

Em seguida, popule o banco de dados com dados de teste usando o seeder do Laravel:

```php artisan db:seed```

Finalmente, inicie o compilador de assets do Laravel Mix para compilar seus assets e assistir a mudanças:

```npm run watch```

Contribuição
Pull requests são bem-vindos. Para grandes alterações, abra uma issue primeiro para discutir o que você gostaria de mudar.

Licença
MIT
