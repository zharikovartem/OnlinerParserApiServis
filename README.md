# Rest сервис для обработки контента и цен конкурентов с onliner.by

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
```

### Endpoints:
Описание разметки файла README.md **[Ссылка на репозиторий](https://github.com/GnuriaN/format-README#%D0%A1%D0%BF%D0%B8%D1%81%D0%BA%D0%B8)**
