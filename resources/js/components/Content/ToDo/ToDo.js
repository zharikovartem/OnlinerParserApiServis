import React, {useState} from 'react';
import { Tree } from 'antd';



// class Demo extends React.Component {
const Demo = (props) => {
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
      console.log('onDrop info: ',info)
    }

    // console.log('render: ', gData);
    return (
        <Tree
            className="draggable-tree"
            defaultExpandedKeys={expandedKeys}
            draggable
            blockNode
            onDragEnter={onDragEnter}
            onDrop={onDrop2}
            treeData={gData}
        />
    );

}

export default Demo;