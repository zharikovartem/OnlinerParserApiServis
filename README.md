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
php artisan db:create onliner_parser_api_servis
php artisan config:clear
php artisan config:cache
php artisan key:generate
php artisan migrate
```

Обновление базы данных
```console
php artisan migrate:fresh
```

Запуск очереди
```console
php artisan queue:work
```

Запуск срвера
```console
php artisan serv
```

Перезапус очереди
```console
php artisan queue:restart
```

### Endpoints:
**[api/startCatalogParsing](http://127.0.0.1:8000/api/startCatalogParsing)** - получить список категорий

???**[api/startCatalogParsing/{caegoryId}](http://127.0.0.1:8000/api/startCatalogParsing/250)**-получить категорию по id

**[api/startCatalogItem/{productName}](http://127.0.0.1:8000/api/startCatalogItem/hoods)** - получить список товаров выбранной категории

**[api/startProductParamParsing/{productType}](http://127.0.0.1:8000/api/startProductParamParsing/hoods)** - Начать парсинг описаний выбранной категории

**[api/startProductParamParsing/{productType}/{productId}](http://127.0.0.1:8000/api/startProductParamParsing/hoods/1)** - Парсинг описаний выбранного по id товара
