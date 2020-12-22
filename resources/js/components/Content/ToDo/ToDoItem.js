import React from 'react';
// import { Tree, Drawer, Form, Button, Col, Row, Input, Select, DatePicker } from 'antd';
import { Collapse, Button } from 'antd';

const { Panel } = Collapse;

const ToDoItem = (props) => {
    function callback(key) {
        console.log(key);
    }

    const onButtonClick = () => {
        console.log('ToDoItem props: ', props)
    }

    
    return (
        // <div>{props.elem.name}</div>
        // добавить id
        <Collapse defaultActiveKey={[]} onChange={callback}>
            <Panel header={props.elem.name} key="1">
                <p>{props.elem.name}</p>
                <Button onClick={onButtonClick}>Подзадача</Button>
            </Panel>
        </Collapse>
    )
}

export default ToDoItem;