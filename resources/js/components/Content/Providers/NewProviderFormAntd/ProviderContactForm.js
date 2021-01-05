import React from 'react';

const ProviderContactForm = (props) => {

    return(
        <div>
            <Form.Item
                label="Контактный телефон"
                name="providerContactPhone"
                rules={[{ required: true, message: 'Введите контактный номер телефона' }]}
                // допилить валидацию номра
            >
                <Input />
            </Form.Item>
        </div>
    )
}

export default ProviderContactForm;