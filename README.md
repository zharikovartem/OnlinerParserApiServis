# Rest сервис для обработки контента и цен конкурентов с onliner.by

### Установка на Хостинг:
```console

```

### Установка на OpenServer:
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


### Полезные статьи:
**[Создание команды php artisan db:create](https://www.techspeak.dev/2018/09/30/laravel-creating-the-database-using-artisan-commands.html)**


Здравствуйте, Артем Жариков.

Мы создали для вас аккаунт хранилища данных для хранения бэкапов и прочих данных.

FTP доступ
Адрес сервера: backup-storage5.hostiman.ru
Порт: 21
Логин: s195317
Пароль: jnyd877B2P

Благодарим за выбор наших услуг.

C радостью сообщаем, что на Ваш сервер была установлена панель управления ISPmanager 5. 

Панель управления ISPmanager 5
=============================
Адрес панели управления: https://81.90.181.175:1500
Логин: root
Пароль: 74NWWkFFhrGM

Техподдержка
=============================
По вопросам поддержки вы можете создать тикет по адресу: https://my.hostiman.ru/cabinet/tickets/create

Для ускорения процесса, пожалуйста, сразу указывайте всю нужную информацию: root пароль, доменные имена, описание проблемы / вид помощи. Таким образом, вы сэкономите наше и свое время, позволив администраторам немедленно начать диагностирование проблемы.