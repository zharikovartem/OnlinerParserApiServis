import React, {useState, useEffect} from 'react';
import {catalogAPI} from './../../api/api';
import { Button, Spin, Space } from 'antd';

const TreeItem = (props) => {
    const [listTarget, setListTarget] = useState(false);
    const [paramsTarget, setParamsTarget] = useState(false);
    const [toggler, setToggler] = useState(false)

    useEffect(() => {
        if (listTarget) {
            props.getProductsList(listTarget);
            setListTarget(false);
            setToggler(true);
        }
        if (paramsTarget) {
            console.log('startDescriptionsParse ', paramsTarget)
            props.startDescriptionsParse(paramsTarget);
            setParamsTarget(false)
            // setToggler(true);
        }
    }, [listTarget, paramsTarget])

    const getList = (name) => {
        setListTarget(name);
    }

    const getParams = (name) => {
        console.log(name)
        setParamsTarget(name)
    }

    if (!toggler) {
        return(
            <div>
                {props.elem.label}({props.elem.total_count})
                <Button type="link" onClick={()=>{getList(props.elem.name)}}>Список товаров</Button>
                <Button type="link" onClick={()=>{getParams(props.elem.name)}}>Получить описания</Button>
            </div>
        );
    } else {
        return (
            <div>
                {props.elem.label}
                <Spin size="small" />
            </div>
        );
    }
}

export default TreeItem;