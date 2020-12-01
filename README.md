# CRM система для розничной интернет торговли 

### Установка на OpenServer:

Устанавливаем Composer:
```console
git clone  https://github.com/zharikovartem/localhost.git
    или
git clone  https://github.com/zharikovartem/localhost.git project_name
cd project_name
composer install
npm install
    Открыть VsCode:
copy .env.example .env
php artisan config:clear
php artisan config:cache
php artisan key:generate
php artisan migrate