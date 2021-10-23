## Installation

Install components
>composer install

Create database tables and populate initial data
>php artisan migrate --seed

Install Laravel Passport and generate client keys and 
save them into .env file
>php artisan passport:install --seed
>
>php artisan passport:client --password

Update components
>composer update

## Server Related Troubleshoting
Passport install failure 
> 

Passport client kehy generation, (add to artisan file)
> define('STDIN',fopen("php://stdin","r"));



