import React, { useState } from 'react';
import { Drawer, Button, Select, Form, Input } from 'antd';
import { PlusOutlined } from '@ant-design/icons';
// import { Input, InputNumber, Checkbox } from 'formik-antd';
import "./styles.css";
import NewProviderForm from './NewProviderForm';
import NewProviderFormAntd from './NewProviderFormAntd/NewProviderFormAntd';

const { Option } = Select;

const Providers = (props) => {
  const [visible, setVisible] = useState(false);
  const [visible2, setVisible2] = useState(false);
  // const [submitting, setSubmitting] = useState();
  const showDrawer = () => {
    setVisible(true);
  };
  const showDrawer2 = () => {
    setVisible2(true);
  };
  const onClose = () => {
    setVisible(false);
    setVisible2(false);
  };


  return (
    <>
      <h3>Providers</h3>
      {/* <p>https://ant.design/components/drawer/</p> */}
      {/* <Button type="primary" onClick={showDrawer}>
        <PlusOutlined />Создать (Formik)
      </Button>
      <Drawer
        title="Formik Drawer"
        width={1040}
        // className="w-100"
        placement="right"
        closable={false}
        onClose={onClose}
        bodyStyle={{ paddingBottom: 80 }}
        visible={visible}
      >
        <NewProviderForm />
      </Drawer> */}
      <br/><br/>
      <Button type="primary" onClick={showDrawer2}>
        <PlusOutlined />Создать (antd)
      </Button>
      <Drawer
        title="Antd Drawer"
        width="90%"
        // className="w-100"
        placement="right"
        closable={false}
        onClose={onClose}
        bodyStyle={{ paddingBottom: 80, minWidth: '310'}}
        visible={visible2}
      >
        <NewProviderFormAntd />
      </Drawer>
    </>
  )
}

export default Providers;