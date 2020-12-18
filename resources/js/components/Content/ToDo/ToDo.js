import React, { useState } from 'react';
import { Tree, Drawer, Form, Button, Col, Row, Input, Select, DatePicker } from 'antd';
import { PlusOutlined } from '@ant-design/icons';


// class Demo extends React.Component {
const Demo = (props) => {
  const [visible, setVisible] = useState(false);
  const showDrawer = () => {
    setVisible(true);
  };

  const onClose = () => {
    setVisible(false);
  };

  const onFinish = values => {
    console.log('Success:', values);
  };

  const onFinishFailed = errorInfo => {
    console.log('Failed:', errorInfo);
  };

  const x = 3;
  const y = 2;
  const z = 1;
  const gData2 = [];

  const generateData = (_level, _preKey, _tns) => {
    const preKey = _preKey || '0';
    const tns = _tns || gData2;
    // console.log('gData', gData2);

    const children = [];
    for (let i = 0; i < x; i++) {
      const key = `${preKey}-${i}`;
      tns.push({ title: key, key });
      if (i < y) {
        children.push(key);
      }
    }
    if (_level < 0) {
      return tns;
    }
    const level = _level - 1;
    children.forEach((key, index) => {
      tns[index].children = [];
      return generateData(level, key, tns[index].children);
    });
  };

  generateData(z);



  const [gData, setgData] = useState(gData2);
  const expandedKeys = ['0-0', '0-0-0', '0-0-0-0'];

  const onDragEnter = info => {
    // console.log(info);
    // expandedKeys 需要受控时设置
    // setState({
    //   expandedKeys: info.expandedKeys,
    // });
  };

  const onDrop = info => {
    // console.log('onDrop info: ', info);
    const dropKey = info.node.props.eventKey;
    console.log('onDrop dropKey: ', dropKey);
    const dragKey = info.dragNode.props.eventKey;
    // console.log('onDrop dragKey: ', dragKey);
    const dropPos = info.node.props.pos.split('-');
    console.log('onDrop dropPos: ', dropPos);
    const dropPosition = info.dropPosition - Number(dropPos[dropPos.length - 1]);
    // console.log('onDrop dropPosition: ', dropPosition);

    const loop = (data, key, callback) => {
      // console.log('start loop data: ', data);
      for (let i = 0; i < data.length; i++) {
        // console.log(i)
        // console.log(key)
        if (data[i].key === key) {
          // console.log('key === key: ', key);
          return callback(data[i], i, data);
        }
        // console.log('data[i]', data[i])
        if (data[i].children) {
          // console.log('children: ', key);
          loop(data[i].children, key, callback);
        }
      }
    };

    const data = [gData];
    // console.log('onDrop data: ', data);

    // Find dragObject
    let dragObj;

    loop(data[0], dragKey, (item, index, arr) => {
      arr.splice(index, 1);
      dragObj = item;
      console.log('arr: ', arr)
      console.log('dragObj: ', dragObj)
    });


    console.log('info.dropToGap: ', info.dropToGap)

    if (!info.dropToGap) {
      // Drop on the content
      loop(data, dropKey, item => {
        item.children = item.children || [];
        // where to insert 示例添加到头部，可以是随意位置
        item.children.unshift(dragObj);
      });
    } else if (
      (info.node.props.children || []).length > 0 && // Has children
      info.node.props.expanded && // Is expanded
      dropPosition === 1 // On the bottom gap
    ) {
      loop(data, dropKey, item => {
        item.children = item.children || [];
        // where to insert 示例添加到头部，可以是随意位置
        item.children.unshift(dragObj);
        // in previous version, we use item.children.push(dragObj) to insert the
        // item to the tail of the children
      });
    } else {
      let ar;
      let i;

      loop(data, dropKey, (item, index, arr) => {
        ar = arr;
        i = index;
      });

      console.log('dropPosition???: ', dropPosition)
      if (dropPosition === -1) {
        console.log('dragObj -1: ', dragObj)
        //     arr.splice(i, 0, dragObj);
      } else {
        console.log('dragObj???: ', dragObj)
        // arr.splice(i + 1, 0, dragObj);
      }
    }

    // setState({
    //   gData: data,
    // });
    console.log('setgData???: ', data)
    // setgData(data);
  };

  const onDrop2 = info => {
    console.log('onDrop info: ', info)
  }

  // console.log('render: ', gData);
  return (
    <>
      <Button type="primary" onClick={showDrawer}>
        <PlusOutlined />Создать
            </Button>
      <Drawer
        title="Новая задача"
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
              onClick={onClose}
              style={{ marginRight: 8 }}
              >
              Cancel
            </Button>
            <Button
              // onClick={this.onClose} 
              htmlType="submit"
              type="primary"
            >
              Submit
                      </Button>
          </div>
        }
      >
        <Form
          layout="vertical"
          hideRequiredMark
          onFinish={onFinish}
          onFinishFailed={onFinishFailed}
        >
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="name"
                label="Наименование"
                rules={[{ required: true, message: 'Не должно быть пустым' }]}
              >
                <Input placeholder="Please enter user name" />
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="url"
                label="Url"
                rules={[{ required: true, message: 'Please enter url' }]}
              >
                <Input
                  style={{ width: '100%' }}
                  addonBefore="http://"
                  addonAfter=".com"
                  placeholder="Please enter url"
                />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="owner"
                label="Owner"
                rules={[{ required: true, message: 'Please select an owner' }]}
              >
                <Select placeholder="Please select an owner">
                  <Option value="xiao">Xiaoxiao Fu</Option>
                  <Option value="mao">Maomao Zhou</Option>
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="type"
                label="Type"
                rules={[{ required: true, message: 'Please choose the type' }]}
              >
                <Select placeholder="Please choose the type">
                  <Option value="private">Private</Option>
                  <Option value="public">Public</Option>
                </Select>
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={12}>
              <Form.Item
                name="approver"
                label="Approver"
                rules={[{ required: true, message: 'Please choose the approver' }]}
              >
                <Select placeholder="Please choose the approver">
                  <Option value="jack">Jack Ma</Option>
                  <Option value="tom">Tom Liu</Option>
                </Select>
              </Form.Item>
            </Col>
            <Col span={12}>
              <Form.Item
                name="dateTime"
                label="DateTime"
                rules={[{ required: true, message: 'Please choose the dateTime' }]}
              >
                <DatePicker.RangePicker
                  style={{ width: '100%' }}
                  getPopupContainer={trigger => trigger.parentElement}
                />
              </Form.Item>
            </Col>
          </Row>
          <Row gutter={16}>
            <Col span={24}>
              <Form.Item
                name="description"
                label="Description"
                rules={[
                  {
                    required: true,
                    message: 'please enter url description',
                  },
                ]}
              >
                <Input.TextArea rows={4} placeholder="please enter url description" />
              </Form.Item>
              <Form.Item >
                <Button type="primary" htmlType="submit" style={{ marginRight: 8 }}>
                  Сохранить
                </Button>
                <Button onClick={onClose} style={{ marginRight: 8 }} >
                  Cancel
                </Button>
              </Form.Item>
            </Col>
          </Row>
        </Form>
      </Drawer>

      <Tree
        className="draggable-tree"
        defaultExpandedKeys={expandedKeys}
        draggable
        blockNode
        onDragEnter={onDragEnter}
        onDrop={onDrop2}
        treeData={gData}
      />
    </>
  );

}

export default Demo;