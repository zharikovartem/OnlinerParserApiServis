import React, { useState, useEffect } from 'react';
import { Form, Input, Button, Checkbox, Select } from 'antd';

const { Option } = Select;

const tailLayout = {
    wrapperCol: { offset: 8, span: 16 },
};

const AuthType = () => {
    const [authType, setAuthType] = useState(false)

    const onChangeAuthType = (e) => {
        // console.log(e)
        // setAuthType(e)
        switch (e) {
            case 'token':
                setAuthType(
                    <Form.Item
                        label="Токен"
                        name="token"
                        rules={[{ required: true, message: 'Введите token для авторизации' }]}
                    >
                        <Input />
                    </Form.Item>
                )
                break;
        
            default:
                setAuthType(e)
                break;
        }
    }

    return (
        <>
            <Form.Item
                label="Способ авторизации"
                name="algoritmRules"
                rules={[{ required: true, message: 'Укажите тип запроса!' }]}
            >
                <Select
                    onChange={onChangeAuthType}
                    allowClear
                >
                    <Option value={false}></Option>
                    <Option value="token">Token</Option>
                    <Option value="auth" disabled >Auth 2.0</Option>
                </Select>

            </Form.Item>
            {authType ? <div>{authType}</div> : null}
        </>
    )
}

const ApiOptions = (props) => {
    const [test, setTest] = useState(false)
    const [algoritmType, setAlgoritmType] = useState(false)

    // useEffect(() => {
    //     console.log('props.authCheck useEffect')
    // }, [props.authCheck])

    const onChangeAlgoritm = (e) => {
        console.log(e)
        setAlgoritmType(e)
    }

    const onChangeToken = (e) => {
        console.log('onChangeToken: ', e.target.checked)
        // props.setAuthCheck(e.target.checked)
        setTest(e.target.checked)
    }
    console.log(props)
    return (
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

            {/* {props.authCheck? <div>auth</div> : null} */}
            {test ? <AuthType /> : null}

            <Form.Item
                label="Алгоритм получения прайса"
                name="apiAlgoritm"
                rules={[{ required: true, message: 'Укажите тип запроса!' }]}
            >
                <Select
                    onChange={onChangeAlgoritm}
                    allowClear
                >
                    <Option value={false}></Option>
                    <Option value="1">Получение кталога - Получение товаров</Option>
                    <Option value="2" disabled>Получение прайса одним запросом</Option>
                </Select>
            </Form.Item>

        </>
    )
}

export default ApiOptions