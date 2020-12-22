import React, {useState, useEffect} from 'react';
import { Tree } from 'antd';

const ToDo = (props) => {

  useEffect(() => {
    if (props.ToDoData.length === 0) {
      props.getToDoList()
    }
  }, [])

  console.log('ToDo props: ', props)

  return (
    <Tree
      checkable
      // defaultExpandedKeys={['0-0-0', '0-0-1']}
      // defaultSelectedKeys={['0-0-0', '0-0-1']}
      // defaultCheckedKeys={['0-0-0', '0-0-1']}
      // onSelect={onSelect}
      // onCheck={onCheck}
      treeData={props.ToDoData}
    />
  )
}

export default ToDo;