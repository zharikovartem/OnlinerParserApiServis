import React from 'react';
import { Form, Input, Button, Checkbox } from 'antd';
import { Redirect } from 'react-router';

const layout = {
  labelCol: { span: 8 },
  wrapperCol: { span: 16 },
};
const tailLayout = {
  wrapperCol: { offset: 8, span: 16 },
};

const Register = (props) => {
  console.log('Register props: ', props);

  const onFinish = values => {
    console.log('Success:', values);
    if (values['password'] === values['c_password']) {
      // delete values['passwordToConfirm']
      props.registerThunkCreator(values);
    }
  };

  const onFinishFailed = errorInfo => {
    console.log('Failed:', errorInfo);
  };

  if (props.isAuth) {
    return <Redirect push to="/" />;
  } else {
    return (
      <section className="p-5">
        <Form
          {...layout}
          name="basic"
          initialValues={{ remember: true }}
          onFinish={onFinish}
          onFinishFailed={onFinishFailed}
        >
          <Form.Item
            label="Name"
            name="name"
            rules={[{ required: true, message: 'Please input your username!' }]}
          >
            <Input className="mr-sm-2" />
          </Form.Item>

          <Form.Item
            label="E-Mail Address"
            name="email"
            rules={[{ required: true, message: 'Please input your E-Mail Address!' }]}
          >
            <Input />
          </Form.Item>

          <Form.Item
            label="Password"
            name="password"
            rules={[{ required: true, message: 'Please input your password!' }]}
          >
            <Input.Password />
          </Form.Item>

          <Form.Item
            label="Confirm Password"
            name="c_password"
            rules={[{ required: true, message: 'Please Confirm your password!' }]}
          >
            <Input.Password autoComplete="new-password" />
          </Form.Item>

          <Form.Item {...tailLayout}>
            <Button type="primary" htmlType="submit">
              Зарегистрироваться
        </Button>
          </Form.Item>
        </Form>
      </section>
    );
  }
}
export default Register