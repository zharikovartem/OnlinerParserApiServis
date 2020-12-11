import React, {useState, useEffect} from 'react';
import {catalogAPI} from './../../api/api';
import { Button } from 'antd';

const TreeItem = (props) => {
    const [listTarget, setListTarget] = useState(false);

    useEffect(() => {
        if (listTarget) {
        console.log('props: ',props);

        catalogAPI.parseProductsList(listTarget).then(response => {
            // dispatch(setCatalogTree(response.data));
            console.log(response)
        });

        setListTarget(false);
        }
    }, [listTarget])

    const onClick = (name) => {
        setListTarget(name);
    }

    return(
        <div>
            {props.elem.label}({props.elem.total_count})
            <Button type="link" onClick={()=>{onClick(props.elem.name)}}>Список товаров</Button>
        </div>
    );
}

export default TreeItem;