import React, {useState} from 'react';
import { Formik, Form, Field, FieldArray, ErrorMessage } from "formik";
import { Select } from 'formik-antd'
import DisplayProviderForm from './DisplayProviderForm';
// import { Select } from 'antd';

import {
    AntDatePicker,
    AntInput,
    AntSelect,
    AntTimePicker
} from "./CreateAntFields";

import {
    validateDate,
    validateEmail,
    validateName,
    isRequired
} from "./ValidateFields";

const { Option } = Select;

const optionsData = [
    { value: 'api', label: 'API', disabled: false },
    { value: 'mail', label: 'Email', disabled: false },
    { value: 'ftp', label: 'FTP', disabled: true },
    { value: 'parser', label: 'Parser', disabled: false },
];

const NewProviderForm = (props) => {
    const [fieldValues, setFieldValues] = useState({});
    const initialValues = {
        data: [],
        loadType: ''
    };

    const validationSchema = (values) => {
        // console.log('validationSchema: ', values)
        let errors = {};
        // const res = Object.assign(fieldValues, values);
        // console.log('!!!res: ', res)
        // setFieldValues(res)
        return errors
    }

    function onChangeLoadType(e, field, values, setValues) {
        // console.log('onChangeLoadType:', e)
        // console.log('fieldValues: ', fieldValues)
        // let valuesCopy = { ...initialValues };
        let valuesCopy = { ...values };
        valuesCopy.data = [];
        valuesCopy.loadType = e;

        switch (e) {
            case 'mail':
                // valuesCopy.data.push({name:'mailAdress', label:'Адрес отправителя', type:'text', value: fieldValues.mailAdress === undefined ? fieldValues.mailAdress : ""})
                valuesCopy.data.push({name:'mailAdress', label:'Адрес отправителя', type:'text', value: values.mailAdress})
                valuesCopy.data.push({name:'fileName', label:'Название прайса в письме', type:'text', value: values.fileName})
                break;

            case 'api':
                valuesCopy.data.push({name:'apiAdress', label:'URL API', type:'text', value: values.apiAdress})
                valuesCopy.data.push({name:'httpType', label:'Вид запроса', type:'text', value: values.httpType})
                valuesCopy.data.push({name:'token', label:'Ключ доступа', type:'password', value: values.token})
                valuesCopy.data.push({name:'alg', label:'Алгоритм получения прайса', type:'select', value: values.token, 
                options: [
                    { value: '1', label: 'Получение кталога -> Получение товаров', disabled: false },
                    { value: '2', label: 'Получение прайса одним запросом', disabled: true },
                ]
            })
                break;
        
            default:
                break;
        }

        console.log('valuesCopy', valuesCopy)
        setValues(valuesCopy)

        field.onChange(e);
    }

    const onChangeAlg = (e, field, values, setValues) => {
        console.log('onChangeAlg: ', e)
        let valuesCopy = { ...values };
        valuesCopy.algData = [];
        switch (e) {
            case '1':
                console.log('case 1')
                valuesCopy.data.push({name:'catalogListApi', label:'URL для получения каталога', type:'text', value: values.catalogListApi});
                valuesCopy.data.push({name:'categoryFieldName', label:'Наименование категории', type:'text', value: values.catalogListApi});
                valuesCopy.data.push({name:'categoryFieldid', label:'Наименование идентификатора категории', type:'text', value: values.catalogListApi});
                valuesCopy.data.push({name:'productsByCatalogItem', label:'URL для получения товаров раздела', type:'text', value: values.catalogListApi});
                break;
        
            default:
                break;
        }
        setValues(valuesCopy)
        console.log('valuesCopy alg: ', valuesCopy)
        field.onChange(e);
    }

    function onSubmit(fields) {
        // display form field values on success
        delete fields.data
        console.log('SUCCESS!! :-)\n\n' + JSON.stringify(fields, null, 4));
    }

    return (
        <Formik initialValues={initialValues} validate={validationSchema} onSubmit={onSubmit}>
            {({ errors, values, touched, setValues }) => (
                <Form>
                    <Field
                        component={AntInput}
                        name="name"
                        type="text"
                        label="Наименование поставщика"
                        validate={validateName}
                        hasFeedback
                    />

                    <div className="form-group ant-row">
                        <div className="ant-col ant-form-item-label"><label>Способ загрузки прайса</label> </div>
                        {/* <div className="ant-form-item-control"> */}
                            <Field name="LoadType" validate={validateName} hasFeedback>
                                {({ field }) => (
                                    <Select
                                        {...field}
                                        className={'ant-form-item-control-input-content' + (errors.numberOfTickets && touched.numberOfTickets ? ' is-invalid' : '')}
                                        onChange={e => onChangeLoadType(e, field, values, setValues)}
                                    >
                                        <Select.Option value=""></Select.Option>
                                        {optionsData.map(i =>
                                            <Select.Option key={i.value} value={i.value} disabled={i.disabled}>{i.label}</Select.Option>
                                        )}
                                    </Select>
                                )}
                            </Field>
                        {/* </div> */}
                        <ErrorMessage name="numberOfTickets" component="div" className="invalid-feedback" />
                    </div>
                    <FieldArray name="params">
                        {() => (values.data.map((target, i) => {
                            const ticketErrors = errors.tickets?.length && errors.tickets[i] || {};
                            const ticketTouched = touched.tickets?.length && touched.tickets[i] || {};
                            return (
                                <div key={i+target.name} className="form-group ant-row">
                                    <div className="ant-col ant-form-item-label">
                                        <label >{target.label}</label>
                                    </div>
                                    <div className="ant-form-item-control">
                                        {
                                            target.type !== 'select'?
                                            <Field 
                                                autoComplete="new-password" 
                                                value={target.value} 
                                                name={target.name} 
                                                type={target.type} 
                                                className={'form-control' + (ticketErrors.name && ticketTouched.name ? ' is-invalid' : '')} 
                                            />
                                            :
                                            <Field name={target.name} >
                                                {({ field }) => (
                                                <Select
                                                    {...field}
                                                    className={'ant-form-item-control-input-content' + (errors.numberOfTickets && touched.numberOfTickets ? ' is-invalid' : '')}
                                                    onChange={e => onChangeAlg(e, field, values, setValues)}
                                                >
                                                    <Select.Option value=""></Select.Option>
                                                    {target.options.map(i =>
                                                        <Select.Option key={i.value} value={i.value} disabled={i.disabled}>{i.label}</Select.Option>
                                                    )}
                                                </Select>
                                                )}
                                            </Field>
                                        }
                                        
                                        <ErrorMessage name={`tickets.${i}.name`} component="div" className="invalid-feedback" />
                                    </div>
                                </div>
                            );
                        }))}
                    </FieldArray>
                    <button type="submit" className="btn btn-primary mr-1">
                        Buy Tickets
                    </button>
                    <button className="btn btn-secondary mr-1" type="reset">Reset</button>
                    {/* <li>default values</li> */}
                    <li>Валидация</li>
                    <li>Api для создания поставщиков</li>
                    <li>Проверка на существование</li>
                    <li>Валидация имени таблицы</li>
                </Form>
            )}
        </Formik>
    );
}

export default NewProviderForm;