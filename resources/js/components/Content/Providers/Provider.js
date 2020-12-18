import React, { useState } from 'react';
import { Drawer, Button } from 'antd';
import { PlusOutlined } from '@ant-design/icons';

const Providers = (props) => {
    const [visible, setVisible] = useState(false);
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
                      <Button 
                        // onClick={this.onClose} 
                        style={{ marginRight: 8 }}>
                        Cancel
                      </Button>
                      <Button 
                        // onClick={this.onClose} 
                        type="primary">
                        Submit
                      </Button>
                    </div>
                  }
            >
                <p>Some contents...</p>
                <p>Some contents...</p>
                <p>Some contents...</p>
            </Drawer>
        </>
    )
}

export default Providers;