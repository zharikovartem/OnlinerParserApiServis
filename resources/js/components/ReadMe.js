import React from 'react';

const ReadMe = () => {
    return (
        <div>
            <h3>Данные для SSH:</h3>
            <p>
                <b>ssh root@81.90.181.175</b> : 74NWWkFFhrGM
                <br/>
                <b>ssh testadmin@81.90.181.175</b> : gfhjkm4501
                <br/>
                <b>cd ../../var/www/www-root/data/www/crmapiserver.h1n.ru</b> - Перейти в директорию проекта
                <br/>
                <b>ls</b> - Показать содержимое каталога (список названий файлов)
            </p>

            <h3>Данные для VDS:</h3>
            <a href="https://81.90.181.175:1500">https://81.90.181.175:1500</a> - админка
            <br/>
            <a href="http://81.90.181.175/phpmyadmin/index.php">http://81.90.181.175/phpmyadmin/index.php</a> 
            - База данных
            <br/>
            <a href="https://81.90.181.175:1500/ispmgr#/list/file/4?path=%2Fvar%2Fwww%2Fwww-root%2Fdata%2Fwww%2Fcrmapiserver.h1n.ru&p_num=1">Менеджер файлов</a> 
            
        </div>
    );
};

export default ReadMe;