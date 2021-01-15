import React, {useState} from 'react';
import { Collapse, message } from 'antd';
import {
    HomeOutlined,
    SettingFilled,
    SmileOutlined,
    SyncOutlined,
    LoadingOutlined,
    CopyOutlined,
  } from '@ant-design/icons';

const { Panel } = Collapse;

const Tab = (props) => {
    let res = [];
    for (let index = 0; index < props.i; index++) {
        res.push(<span key={props.i}>&#160;&#160;&#160;&#160;</span>)
    }
    return res;
}

const UrlCopyed = (props) => {
    const [copyed, setCopyed] = useState(null);
    const copy = (value) => {
        navigator.clipboard.writeText(value)
        message.success(value + '- скопирован');
    }

    return(
        <p>
            { props.pre ? <span>{props.pre} <Tab i="1" /></span> : null }
            <b>{props.value}</b>
            <Tab i="1" />
            <CopyOutlined 
                        onClick={()=>{copy(props.value)}}
            />
            {props.descriptions ?
                <span> {props.descriptions}</span>
                :
                null
            }
        </p>
    )
}

const ReadMe = () => {
    const copy = (value) => {
        // console.log(e.target.parentNode)
        navigator.clipboard.writeText(value)
        message.success(value + '- скопирован');
    }
    return (
        <div>
            <h3>Данные для SSH:</h3>
            <p>
                <b>ssh root@81.90.181.175</b> : 74NWWkFFhrGM
                <br />
                <b>ssh testadmin@81.90.181.175</b> : gfhjkm4501
                <br />
                <b>cd ../../var/www/www-root/data/www/crmapiserver.h1n.ru</b> - Перейти в директорию проекта
                <br />
                <b>ls</b> - Показать содержимое каталога (список названий файлов)
            </p>

            <h3>Данные для VDS:</h3>
            <a href="https://artcrmvds.h1n.ru/">Сайт продакшен</a> - админка
            <br />
            <a href="https://81.90.181.175:1500">https://81.90.181.175:1500</a> - админка
            <br />
            <a href="http://81.90.181.175/phpmyadmin/index.php">http://81.90.181.175/phpmyadmin/index.php</a>
            - База данных
            <br />
            <a href="https://81.90.181.175:1500/ispmgr#/list/file/4?path=%2Fvar%2Fwww%2Fwww-root%2Fdata%2Fwww%2Fcrmapiserver.h1n.ru&p_num=1">Менеджер файлов</a>

            <h3>Обраить внимание</h3>
            https://ant.design/components/steps/
            <br />
            php artisan make:controller Api/Auth/AuthController

            <Collapse defaultActiveKey={[]} >
                <Panel header="Endpoints" key="1">
                    <UrlCopyed value="http://127.0.0.1:8000/api/getCatalogParts" descriptions="получить спаршенное дерево категорий"/>
                    <UrlCopyed value="http://127.0.0.1:8000/api/startCatalogParsing" descriptions="получить список категорий"/>
                    <UrlCopyed value="http://127.0.0.1:8000/api/startCatalogItem/hoods" descriptions="получить список товаров выбранной категории"/>
                    <UrlCopyed value="http://127.0.0.1:8000/api/startProductParamParsing/hoods" descriptions="Начать парсинг описаний выбранной категории "/>
                    <UrlCopyed value="http://127.0.0.1:8000/api/startProductParamParsing/hoods/1" descriptions="Парсинг описаний выбранного по id товара"/>
                    <UrlCopyed value="http://127.0.0.1:8000/api/getProductDescriptions/hoods" descriptions="Получить готовые описания для выбранной группы товаров"/>
                </Panel>
                <Panel header="Git" key="2">
                    Загрузка на VDS:
                    <p>
                        <b>git stash</b> 
                        <CopyOutlined 
                        onClick={()=>{copy('git stash')}}
                        />
                        - Схранение изменений в локальном хранилеще с возможностью дальнейшей работы
                    </p>
                    <p>
                        <b>git pull</b>
                        <CopyOutlined 
                        onClick={()=>{copy('git pull')}}
                        />
                    </p>
                    <Collapse defaultActiveKey={[]} >
                        <Panel header="Клонирование с git" key="2-1">
                            <UrlCopyed 
                                value="git clone  https://github.com/zharikovartem/OnlinerParserApiServis.git project_name" 
                                descriptions=" - Клонируем с репозитория"
                                pre="1)"
                            />
                            <UrlCopyed 
                                value="cd project_name" 
                                descriptions=" - Переходим в корневую папку проекта"
                                pre="2)"
                            />
                            <UrlCopyed 
                                value="composer install" 
                                descriptions=" - Устанавливаем composer"
                                pre="3)"
                            />
                            <p><Tab i="1" /> Переходим в VsCode</p>
                            <UrlCopyed 
                                value="npm install" 
                                descriptions=" - Устанавливаем NPM"
                                pre="4)"
                            />
                            <UrlCopyed 
                                value="copy .env.example .env" 
                                descriptions=" - Заменяем файл настроек"
                                pre="5)"
                            />
                            <p> *)<Tab i="1" /> Для локальной версии: <br/>
                                <Tab i="2" /><code>DB_DATABASE=OnlinerParserApiServis</code><br/>
                                <Tab i="2" /><code>DB_USERNAME=root</code><br/>
                                <Tab i="2" /><code>DB_PASSWORD=</code>
                            </p>
                            <UrlCopyed 
                                value="php artisan config:clear" 
                                descriptions=" - Чистим конфиг"
                                pre="6)"
                            />
                            <UrlCopyed 
                                value="php artisan config:cache" 
                                descriptions=" - Чистим кэш"
                                pre="7)"
                            />
                            <UrlCopyed 
                                value="php artisan key:generate" 
                                descriptions=" - Генерируем ключ"
                                pre="8)"
                            />
                            <UrlCopyed 
                                value="php artisan migrate" 
                                descriptions=" - Мегрируем БД"
                                pre="9)"
                            />

                        </Panel>
                    </Collapse>
                </Panel>
                <Panel header="Artisan" key="3">
                    <p>
                        <b>php artisan migrate:fresh</b>
                        <CopyOutlined 
                        onClick={()=>{copy('php artisan migrate:fresh')}}
                        />
                    </p>
                    <p>
                        <b>php artisan queue:work</b>
                        <CopyOutlined 
                        onClick={()=>{copy('php artisan queue:work')}}
                        />
                    </p>
                    <p>
                        <b>php artisan queue:work --tries=10</b>
                        <CopyOutlined 
                        onClick={()=>{copy('php artisan queue:work --tries=10')}}
                        />
                    </p>
                    <p>
                        <b>php artisan queue:restart</b>
                        <CopyOutlined 
                        onClick={()=>{copy('php artisan queue:restart')}}
                        />
                    </p>
                        <UrlCopyed value="php artisan queue:work --sleep=5" descriptions="Ждем 5 секунд ???"/>
                    <p>Migrations:</p>
                        <UrlCopyed value="php artisan make:migration create_users_table --create=users" descriptions="Создание новой миграции"/>
                        <UrlCopyed value="php artisan migrate" descriptions=""/>
                    <p>Controllers:</p>
                        <UrlCopyed value="php artisan make:controller Api/Auth/AuthController" descriptions="Создание нового контроллера"/>
                    <p>Models:</p>
                    
                        <UrlCopyed 
                            value="php artisan make:model User --migration" 
                            descriptions="Создать миграцию БД при создании модели"
                        />
                    <p>Siders:</p>
                </Panel>
                <Panel header="Laravel" key="4">
                    <UrlCopyed value="php artisan make:controller PhotoController --resource" descriptions="Создание ресурсного контроллера"/>
                    <Collapse defaultActiveKey={[]} >
                        <Panel header="Создание модели с контроллером" key="4-1">
                            <UrlCopyed value="php artisan make:model Todo -mcr" descriptions="Создание ресурсного контроллера с привязкой к модели и миграцией"/>
                            <span>Создается контроллер, модель, миграция</span>
                            <h5>1. Заполнение модели:</h5>
                                <UrlCopyed 
                                    value="protected $table = 'NameInDB';" 
                                    descriptions=" - Указать название таблици в базе данных"
                                    pre="1.1)"
                                />
                                <UrlCopyed 
                                    value="protected $fillable = ['name', 'user_id', 'date',];" 
                                    descriptions=" - Определить, для каких атрибутов разрешить массовое назначение"
                                    pre="1.2)"
                                />
                                <UrlCopyed 
                                    value="protected $primaryKey = 'flight_id';" 
                                    descriptions=" - Первичные ключи, если id то можно пропустить"
                                    pre="1.3)"
                                />
                                <UrlCopyed 
                                    value="protected $attributes = ['delayed' => false,];" 
                                    descriptions=" - Значения по умолчанию"
                                    pre="1.4) "
                                />
                                <UrlCopyed 
                                    value="use Illuminate\Database\Eloquent\SoftDeletes;" 
                                    descriptions=" - Подключаем для мягкого удаления"
                                    pre="1.5.1) "
                                />
                                <UrlCopyed 
                                    value="use SoftDeletes;" 
                                    descriptions=" - Прописываем в теле класса"
                                    pre="1.5.2) "
                                />

                                <h5>2. Заполнение Контроллера:</h5>
                                <UrlCopyed 
                                    value='use App\Task;' 
                                    descriptions=" - Подключить модель в контроллер"
                                    pre="2.1) "
                                />
                                <UrlCopyed 
                                    value='return response()->json([
                                        "Tasks"=> Task::all()
                                        ], 200);' 
                                    descriptions="}"
                                    pre="2.2) public function index() {"
                                />
                                <UrlCopyed 
                                    value='$newTask = new Task;
                                        $newTask->name = "test_to ".$request->get("user_id");
                                        $newTask->user_id = $request->get("user_id");
                                        $newTask->date = now();
                                        $newTask->save();' 
                                    descriptions="}"
                                    pre="2.3) public function store(Request $request) {"
                                />
                                
                                <p>2.4 В методе show() заменить $article на модель и вернуть его</p>
                                <p>2.5) update():</p>
                                <pre>
                                    <code>
                                        public function update(Request $request, Task $task)<br/>
                                        &#123; <br/>
                                        <Tab i="1"/>$fields = $request-&#62;all();<br/>
                                        <Tab i="1"/>foreach ($fields as $field =&#62; $value) &#123;<br/>
                                        <Tab i="2"/>if (isset($task[$field])) &#123; <br/>
                                        <Tab i="3"/>$task[$field] = $value;<br/>
                                        <Tab i="2"/>&#125; else &#123;<br/>
                                        <Tab i="3"/>$message[$field] = 'do not exist';<br/>
                                        <Tab i="2"/>&#125;<br/>
                                        <Tab i="1"/>&#125;<br/>
                                        <Tab i="1"/>$task-&#62;save();<br/>
                                        <Tab i="1"/>if (!isset($message)) &#123;<br/>
                                        <Tab i="2"/>return response()-&#62;json([<br/>
                                        <Tab i="3"/>$task,<br/>
                                        <Tab i="2"/>], 200);<br/>
                                        <Tab i="1"/>&#125; else &#123;<br/>
                                        <Tab i="2"/>return response()-&#62;json(['error'=&#62;true, 'message'=&#62;$message], 401);<br/>
                                        <Tab i="1"/>&#125;<br/>
                                        &#125;
                                    </code>
                                </pre>

                                // Авторизация

                                <h5>3. Настройка миграции:</h5>
                                <li>php artisan make:migration create_users_table</li>
                                <li>3.1 Прописать филды</li>
                                <Collapse>
                                    <Panel header="Типы полей:" key="4-1-1">
                                        <UrlCopyed 
                                            value="$table->softDeletes();" 
                                            descriptions=" - Мягкое удаление"
                                            pre="1)"
                                        />
                                        <UrlCopyed 
                                            value="$table->bigInteger('votes');" 
                                            descriptions=" - Поле BIGINT"
                                            pre="2)"
                                        />
                                        <UrlCopyed 
                                            value="$table->binary('data');" 
                                            descriptions=" - Поле BLOB"
                                            pre="3)"
                                        />
                                        <UrlCopyed 
                                            value="$table->boolean('confirmed');" 
                                            descriptions=" - Поле BOOLEAN"
                                            pre="4)"
                                        />
                                        <UrlCopyed 
                                            value="$table->char('name', 4);" 
                                            descriptions=" - Поле CHAR с указанной длиной"
                                            pre="5)"
                                        />
                                        <UrlCopyed 
                                            value="$table->date('created_at');" 
                                            descriptions=" - Поле DATE"
                                            pre="6)"
                                        />
                                        <UrlCopyed 
                                            value="$table->dateTime('created_at');" 
                                            descriptions=" - Поле DATETIME"
                                            pre="7)"
                                        />
                                        <UrlCopyed 
                                            value="$table->decimal('amount', 5, 2);" 
                                            descriptions=" - Поле DECIMAL с указанной размерностью и точностью"
                                            pre="8)"
                                        />
                                        <UrlCopyed 
                                            value="$table->double('column', 15, 8);" 
                                            descriptions=" - Поле DOUBLE с указанной точностью"
                                            pre="9)"
                                        />
                                        <UrlCopyed 
                                            value="$table->enum('choices', array('foo', 'bar'));" 
                                            descriptions=" - Поле ENUM"
                                            pre="10)"
                                        />
                                        <UrlCopyed 
                                            value="$table->float('amount');" 
                                            descriptions=" - Поле FLOAT"
                                            pre="11)"
                                        />
                                        <UrlCopyed 
                                            value="$table->increments('id');" 
                                            descriptions=" - Первичный последовательный ключ (autoincrement)"
                                            pre="12)"
                                        />
                                        <UrlCopyed 
                                            value="$table->integer('votes');" 
                                            descriptions=" - Поле INTEGER"
                                            pre="13)"
                                        />
                                        <UrlCopyed 
                                            value="$table->longText('description');" 
                                            descriptions=" - Поле LONGTEXT"
                                            pre="14)"
                                        />
                                        <UrlCopyed 
                                            value="$table->mediumText('description');" 
                                            descriptions=" - Поле MEDIUMTEXT"
                                            pre="15)"
                                        />
                                        <UrlCopyed 
                                            value="$table->morphs('taggable');" 
                                            descriptions=" - Добавляет INTEGER поле taggable_id и STRING поле taggable_type"
                                            pre="16)"
                                        />
                                        <UrlCopyed 
                                            value="$table->smallInteger('votes');" 
                                            descriptions=" - Поле SMALLINT"
                                            pre="17)"
                                        />
                                        <UrlCopyed 
                                            value="$table->string('email');" 
                                            descriptions=" - Поле VARCHAR"
                                            pre="18)"
                                        />
                                        <UrlCopyed 
                                            value="$table->string('name', 100);" 
                                            descriptions=" - Поле VARCHAR с указанной длиной"
                                            pre="19)"
                                        />
                                        <UrlCopyed 
                                            value="$table->text('description');" 
                                            descriptions=" - Поле TEXT"
                                            pre="20)"
                                        />
                                        <UrlCopyed 
                                            value="$table->time('sunrise');" 
                                            descriptions=" - Поле TIME"
                                            pre="21)"
                                        />
                                        <UrlCopyed 
                                            value="$table->timestamp('added_on');" 
                                            descriptions=" - Поле TIMESTAMP"
                                            pre="22)"
                                        />
                                        <UrlCopyed 
                                            value="$table->timestamps();" 
                                            descriptions=" - Добавляет поля created_at и updated_at"
                                            pre="23)"
                                        />
                                        <UrlCopyed 
                                            value="$table->tinyInteger('numbers');" 
                                            descriptions=" - Поле TINYINT"
                                            pre="24)"
                                        />
                                        <UrlCopyed 
                                            value="$table->rememberToken();" 
                                            descriptions=" - Добавляет поле remember_token с типом VARCHAR(100) NULL"
                                            pre="25)"
                                        />
                                        <UrlCopyed 
                                            value="$table->nullableTimestamps();" 
                                            descriptions=" - То же, что и timestamps(), но разрешены значения NULL"
                                            pre="26)"
                                        />
                                    </Panel>
                                    <Panel header="Свойства полей:" key="4-1-2">
                                        <UrlCopyed 
                                            value="->nullable()" 
                                            descriptions=" - Указывает, что поле может быть NULL"
                                            pre="1)"
                                        />
                                        <UrlCopyed 
                                            value="->default($value)" 
                                            descriptions=" - Указывает значение по умолчанию для поля"
                                            pre="2)"
                                        />
                                        <UrlCopyed 
                                            value="->unsigned()" 
                                            descriptions=" - Обозначает беззнаковое число (UNSIGNED)"
                                            pre="3)"
                                        />
                                    </Panel>
                                </Collapse>

                                <h5>4. Создание сидера:</h5>
                        </Panel>
                        <Panel header="Изменение модели" key="4-2">
                            Изменение модели
                        </Panel>
                    </Collapse>
                </Panel>
                <Panel header="Данные для SSH и VDS" key="5"></Panel>
                <Panel header="React" key="6">
                    <Collapse>
                        <Panel header="Подключение Redux" key="6-1">
                            <UrlCopyed 
                                value="npm i react-redux redux -s" 
                                descriptions=" - Устанавливаем расширения"
                                pre="1)"
                            />
                            <UrlCopyed 
                                value="npm i --save-dev @types/react-redux" 
                                descriptions=" - Получаем типы react-redux"
                                pre="2)"
                            />
                            <UrlCopyed 
                                value="npm i --save-dev @types/redux" 
                                descriptions=" - Получаем типы redux"
                                pre="3)"
                            />
                               
                            <UrlCopyed 
                                value="import { Provider } from 'react-redux';" 
                                descriptions=" - Подключаем Provider "
                                pre="4)"
                            />
                            <UrlCopyed 
                                value="<Provider store={store}>" 
                                descriptions=" - Оборачиваем корневой компонент в Provider "
                                pre="5)"
                            />
                            <UrlCopyed 
                                value="import store from './redux/store';" 
                                descriptions=" - Подключаем store"
                                pre="6)"
                            />
                            <UrlCopyed 
                                value="MD redux" 
                                descriptions=" - создаем папку redux"
                                pre="6)"
                            />
                            <UrlCopyed 
                                value="CD src/redux" 
                                descriptions=" - переходим в папку redux"
                                pre="6)"
                            />
                            <UrlCopyed 
                                value="echo $null >> store.tsx" 
                                descriptions=" - Создаем файл"
                                pre="7)"
                            />
                            <UrlCopyed 
                                value="npm i redux-thunk -s" 
                                descriptions=" - Устанавливаем redux-thunk"
                                pre=")"
                            />
                        </Panel>
                    </Collapse>
                </Panel>
            </Collapse>
            

            jwt-auth secret [INk0XG6ac7zgH2zp1w7Q5EDYqOvKuYVYFmzyhE3TjQr3IowHyDj4uMLop1a11qNb] set successfully.
        </div>
    );
};

export default ReadMe;