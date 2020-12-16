import React from 'react';
import { Collapse } from 'antd';
import {
    HomeOutlined,
    SettingFilled,
    SmileOutlined,
    SyncOutlined,
    LoadingOutlined,
    CopyOutlined,
  } from '@ant-design/icons';

const { Panel } = Collapse;

const ReadMe = () => {
    const copy = (value) => {
        // console.log(e.target.parentNode)
        navigator.clipboard.writeText(value)
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

            <Collapse defaultActiveKey={[]} 
            // onChange=""
            >
                <Panel header="Endpoints" key="1">
                http://127.0.0.1:8000/api/getCatalogParts)** - получить спаршенное дерево категорий
                <br />http://127.0.0.1:8000/api/startCatalogParsing)** - получить список категорий
                <br />http://127.0.0.1:8000/api/startCatalogItem/hoods)** - получить список товаров выбранной категории
                <br />http://127.0.0.1:8000/api/startProductParamParsing/hoods)** - Начать парсинг описаний выбранной категории 
                <br />http://127.0.0.1:8000/api/startProductParamParsing/hoods/1)** - Парсинг описаний выбранного по id товара
                <br />http://127.0.0.1:8000/api/getProductDescriptions/hoods)** - Получить готовые описания для выбранной группы товаров
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
                        <b>php artisan queue:restart</b>
                        <CopyOutlined 
                        onClick={()=>{copy('php artisan queue:restart')}}
                        />
                    </p>
                </Panel>
            </Collapse>
        </div>
    );
};

export default ReadMe;