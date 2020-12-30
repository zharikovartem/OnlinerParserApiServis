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
        let valuesCopy = {...values};
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
        }
        setValues(valuesCopy)

        field.onChange(e);
    }

    function onSubmit(fields) {
        // display form field values on success
        console.log('SUCCESS!! :-)\n\n' + JSON.stringify(fields, null, 4));
    }

    return (
        <Formik initialValues={initialValues}  onSubmit={onSubmit}>
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
                    {/* <div className="card m-3">
                        <div className="card-body border-bottom">
                            <div className="form-row">*/}
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
                                                {   [
                                                    {value: 'api', label:'API', disabled: false},
                                                    {value: 'mail', label:'Email', disabled: false},
                                                    {value: 'ftp', label:'FTP', disabled: true},
                                                    {value: 'parser', label:'Parser', disabled: false},
                                                    ].map(i => 
                                                    <option key={i.value} value={i.value} disabled={i.disabled}>{i.label}</option>
                                                )}
                                            </select>
                                        )}
                                        </Field>
                                    </div>
                                    <ErrorMessage name="numberOfTickets" component="div" className="invalid-feedback" />
                                 </div>
                            {/*</div>
                        </div> */}
                        <FieldArray name="params">
                        {() => (values.data.map((ticket, i) => {
                            console.log('ticket'+i, ticket)
                            const ticketErrors = errors.tickets?.length && errors.tickets[i] || {};
                            const ticketTouched = touched.tickets?.length && touched.tickets[i] || {};
                            return (
                                <div key={i} className="list-group list-group-flush">
                                    <div className="list-group-item">
                                        {/* <h5 className="card-title">Ticket {i + 1}</h5> */}
                                        <div className="form-row">
                                            {/* <div className="form-group col-6"> */}
                                            {/* <div className="form-group"> */}
                                                <label className="ant-form-item-label">{ticket}</label>
                                                <Field name={ticket} type="text" className={'form-control col-8' + (ticketErrors.name && ticketTouched.name ? ' is-invalid' : '' )} />
                                                <ErrorMessage name={`tickets.${i}.name`} component="div" className="invalid-feedback" />
                                            {/* </div> */}
                                            {/* <div className="form-group col-6">
                                                <label>Email</label>
                                                <Field name={`tickets.${i}.email`} type="text" className={'form-control' + (ticketErrors.email && ticketTouched.email ? ' is-invalid' : '' )} />
                                                <ErrorMessage name={`tickets.${i}.email`} component="div" className="invalid-feedback" />
                                            </div> */}
                                        </div>
                                    </div>
                                </div>
                            );
                        }))}
                        </FieldArray>
                        {/* <div className="card-footer text-center border-top-0"> */}
                            <button type="submit" className="btn btn-primary mr-1">
                                Buy Tickets
                            </button>
                            <button className="btn btn-secondary mr-1" type="reset">Reset</button>
                        {/* </div> */}
                    {/* </div> */}
                </Form>
            )}
        </Formik>
    );
}

export default NewProviderForm;