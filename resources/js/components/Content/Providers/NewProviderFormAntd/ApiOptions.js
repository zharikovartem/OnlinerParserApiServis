import React, {useState} from 'react';
import { Form, Input, Button, Checkbox, Select } from 'antd';

const { Option } = Select;

const tailLayout = {
    wrapperCol: { offset: 8, span: 16 },
};

const ApiOptions = (props) => {
    // 

    const onChangeToken = (e) => {
        console.log(e.target.checked)
        props.setAuthCheck(e.target.checked)
    }
    console.log(props)
    return(
        <>
            <Form.Item
                label="URL API"
                name="baseApi"
                rules={[{ required: true, message: 'Укажите базовый адрес сервера!' }]}
            >
                <Input />
            </Form.Item>

            <Form.Item
                label="Тип запроса"
                name="requestMethod"
                rules={[{ required: true, message: 'Укажите тип запроса!' }]}
            >
                <Select allowClear>
                    <Option value="post">POST</Option>
                    <Option value="get">GET</Option>
                </Select>
            </Form.Item>

            <Form.Item {...tailLayout} name="hasToken" valuePropName="checked">
                <Checkbox onChange={onChangeToken}>Аунтификация</Checkbox>
            </Form.Item>

            {props.authCheck? <div>auth</div> : null}

            <Form.Item
                label="Алгоритм получения прайса"
                name="algoritmRules"
                rules={[{ required: true, message: 'Укажите тип запроса!' }]}
            >
                <Select 
                    // onChange={onChangeLoadType}
                    allowClear
                >
                    <Option value="1">Получение кталога -> Получение товаров</Option>
                    <Option value="2" disabled>Получение прайса одним запросом</Option>
                </Select>
            </Form.Item>
        </>
    )
}

export default ApiOptions