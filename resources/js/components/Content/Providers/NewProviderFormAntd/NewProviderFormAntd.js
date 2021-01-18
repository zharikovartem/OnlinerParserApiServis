import React, {useState} from 'react';
import { Form, Input, Button, Checkbox, Select } from 'antd';
import ApiOptions from './ApiOptions';

const { Option } = Select;

const layout = {
    labelCol: { span: 8 },
    wrapperCol: { span: 16 },
};
const tailLayout = {
    wrapperCol: { offset: 8, span: 16 },
};

const NewProviderFormAntd = (props) => {
    const [loadType, setLoadType] = useState(false)
    const [authCheck, setAuthCheck] = useState(false);

    const onFinish = values => {
        console.log('Success:', values);
    };

    const onFinishFailed = errorInfo => {
        console.log('Failed:', errorInfo);
    };

    const onChangeLoadType = (e) => {
        console.log(e)
        switch (e) {
            case 'api':
                setLoadType(<ApiOptions/>)
                break;
        
            default:
                setLoadType(false)
                break;
        }
    }

    console.log('authCheck: ', authCheck)
    return (
        <Form
            {...layout}
            name="basic"
            initialValues={{ remember: true }}
            onFinish={onFinish}
            onFinishFailed={onFinishFailed}
        >
            <Form.Item
                label="Наименование поставщика"
                name="name"
                rules={[{ required: true, message: 'Поле обязательно для заполнения!' }]}
            >
                <Input />
            </Form.Item>

            <Form.Item
                label="Способ загрузки прайса"
                name="loadType"
                rules={[{ required: true, message: 'Please input your password!' }]}
            >
                <Select allowClear onChange={onChangeLoadType}>
                    <Option value="mail">Email</Option>
                    <Option value="ftp" disabled>FTP</Option>
                    <Option value="api">API</Option>
                    <Option value="parser" disabled>Parser</Option>
                </Select>
            </Form.Item>

            {loadType}
            {/* {authCheck ? <div>authCheck</div> : null} */}

            {/* < ProviderContactForm /> */}
            <p>Адрес и время работы</p>


            <Form.Item {...tailLayout}>
                <Button type="primary" htmlType="submit">
                    Submit
        </Button>
            </Form.Item>
        </Form>
    )
}

export default NewProviderFormAntd