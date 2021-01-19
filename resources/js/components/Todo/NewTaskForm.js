import * as React from 'react'
import moment from 'moment'
import { Form, Input, Button, DatePicker, TimePicker } from 'antd'

const layout = {
    labelCol: { span: 8 },
    wrapperCol: { span: 16 },
}
const tailLayout = {
    wrapperCol: { offset: 8, span: 16 },
}

// type PropsType = {
//     selectedDate: moment.Moment
// }

const { TextArea } = Input;

const timeFormat = 'HH:mm';

const NewTaskForm = (props) => {
    const onFinish = (values) => {
        console.log('Success:', values)
        console.log('props:', props)
        console.log('taskTime', values.taskTime.format('HH:mm'))
        values.user_id = props.user.id
        values.taskTime = values.taskTime.format('HH:mm');
        values.date = values.date.format('YYYY-MM-DD');
        props.createNewTask(values)
    };

    const onFinishFailed = (errorInfo) => {
        console.log('Failed:', errorInfo);
    };

    const onTimeChange = (value, dateString) => {
        console.log(value, dateString);
    }

    return (
        <Form
            {...layout}
            name="basic"
            initialValues={{ remember: true }}
            onFinish={onFinish}
            onFinishFailed={onFinishFailed}
        >
            <Form.Item
                label="Task name"
                name="taskNime"
                rules={[{ required: true, message: 'Please input task name!' }]}
            >
                <Input />
            </Form.Item>

            <Form.Item
                label="Task time"
                name="taskTime"
                rules={[{ required: true, message: 'Please input time!' }]}
            >
                <TimePicker
                    onChange={onTimeChange} 
                    // defaultValue={moment('12:08', timeFormat)} 
                    format={timeFormat} 
                />
            </Form.Item>
            <Form.Item
                label="Task date"
                name="date"
                // rules={[{ required: true, message: 'Please input time!' }]}
            >
                <DatePicker 
                    // onChange={onTimeChange} 
                    // defaultValue={moment('12:08', timeFormat)} 
                    // format={timeFormat} 
                />
            </Form.Item>

            <Form.Item
                label="Description"
                name="description"
            >
                <TextArea rows={2} />
            </Form.Item>

            <Form.Item {...tailLayout}>
                <Button type="primary" htmlType="submit">
                    Create
                </Button>
            </Form.Item>
        </Form>
    )
}

export default NewTaskForm