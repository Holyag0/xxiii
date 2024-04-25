# xxiii 
começo do projeto
centro de formação de condutores (cfc)


Prerequisites
Before you start, make sure you have the following installed on Docker or Laravel Sail:

PHP 8.0 or higher
Composer
Node.js
NPM
MySQL
Nginx (optional)

- Installation
First, clone the repository to your local machine:

```git clone <my-repository-url>```

I*nstall the PHP dependencies with Composer:

```composer install```

Install the Node.js dependencies with NPM:

```npm install```

- Execution
After installing all dependencies, you can set up the database by running the Laravel migrations:

```php artisan migrate```

Then, populate the database with test data using the Laravel seeder:

```php artisan db:seed```

Finally, start the Laravel Mix asset compiler to compile your assets and watch for changes:

```npm run watch```

Contribution
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

License
MIT

I hope this helps! If you have any other questions or need further assistance, feel free to ask.
