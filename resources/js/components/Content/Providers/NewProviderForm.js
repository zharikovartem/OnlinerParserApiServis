import React from 'react';
import { Formik, Form, Field, FieldArray, ErrorMessage } from "formik";
import DisplayProviderForm from './DisplayProviderForm';
import { Select } from 'antd';

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

const NewProviderForm = (props) => {
    const initialValues = {
        numberOfTickets: '',
        data: [],
        loadType: ''
    };

    // const validationSchema = Yup.object().shape({
    //     numberOfTickets: Yup.string()
    //         .required('Number of tickets is required'),
    //     tickets: Yup.array().of(
    //         Yup.object().shape({
    //             name: Yup.string()
    //                 .required('Name is required'),
    //             email: Yup.string()
    //                 .email('Email is invalid')
    //                 .required('Email is required')
    //         })
    //     )
    // });

    function onChangeLoadType(e, field, values, setValues) {
        let valuesCopy = { ...values };
        valuesCopy.data = [];
        valuesCopy.loadType = e.target.value;
        if (e.target.value === 'mail') {
            valuesCopy.mailData = {};
            valuesCopy.data.push('mailAdress')
            valuesCopy.data.push('fileName')
        }
        if (e.target.value === 'api') {
            valuesCopy.mailData = {};
            valuesCopy.data.push('apiAdress')
            valuesCopy.data.push('getType')
        }
        setValues(valuesCopy)

        field.onChange(e);
    }

    function onSubmit(fields) {
        // display form field values on success
        console.log('SUCCESS!! :-)\n\n' + JSON.stringify(fields, null, 4));
    }

    return (
        <Formik initialValues={initialValues} onSubmit={onSubmit}>
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
                        <div className="ant-form-item-control">
                            <Field name="LoadType">
                                {({ field }) => (
                                    <select
                                        {...field}
                                        className={'form-control' + (errors.numberOfTickets && touched.numberOfTickets ? ' is-invalid' : '')}
                                        onChange={e => onChangeLoadType(e, field, values, setValues)}
                                    >
                                        <option value=""></option>
                                        {[
                                            { value: 'api', label: 'API', disabled: false },
                                            { value: 'mail', label: 'Email', disabled: false },
                                            { value: 'ftp', label: 'FTP', disabled: true },
                                            { value: 'parser', label: 'Parser', disabled: false },
                                        ].map(i =>
                                            <option key={i.value} value={i.value} disabled={i.disabled}>{i.label}</option>
                                        )}
                                    </select>
                                )}
                            </Field>
                        </div>
                        <ErrorMessage name="numberOfTickets" component="div" className="invalid-feedback" />
                    </div>
                    <FieldArray name="params">
                        {() => (values.data.map((ticket, i) => {
                            console.log('ticket' + i, ticket)
                            const ticketErrors = errors.tickets?.length && errors.tickets[i] || {};
                            const ticketTouched = touched.tickets?.length && touched.tickets[i] || {};
                            return (
                                <div className="form-group ant-row">
                                    <div className="ant-col ant-form-item-label"><label className="ant-form-item-label">{ticket}</label></div>
                                    <div className="ant-form-item-control">
                                        <Field name={ticket} type="text" className={'form-control' + (ticketErrors.name && ticketTouched.name ? ' is-invalid' : '')} />
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
                    <li>Допилить обьект loadType</li>
                    <li>switch</li>
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