import React, { useState } from 'react';
import { Drawer, Button, Select, Form, Input } from 'antd';
import { PlusOutlined } from '@ant-design/icons';
// import { Input, InputNumber, Checkbox } from 'formik-antd';
import "./styles.css";
import NewProviderForm from './NewProviderForm';

const { Option } = Select;

const Providers = (props) => {
  const [visible, setVisible] = useState(false);
  // const [submitting, setSubmitting] = useState();
  const showDrawer = () => {
    setVisible(true);
  };
  const onClose = () => {
    setVisible(false);
  };


  return (
    <>
      <h3>Providers</h3>
      <p>https://ant.design/components/drawer/</p>
      <Button type="primary" onClick={showDrawer}>
        <PlusOutlined />Создать
            </Button>
      <Drawer
        title="Basic Drawer"
        width={720}
        placement="right"
        closable={false}
        onClose={onClose}
        bodyStyle={{ paddingBottom: 80 }}
        visible={visible}
        footer={
          <div
            style={{
              textAlign: 'right',
            }}
          >
            {/* <Button
              // onClick={this.onClose} 
              style={{ marginRight: 8 }}>
              Cancel
                      </Button>
            <Button
              // onClick={this.onClose} 
              type="primary">
              Submit  
            </Button> */}
          </div>
        }
      >
        <NewProviderForm />

      </Drawer>
    </>
  )
}

export default Providers;