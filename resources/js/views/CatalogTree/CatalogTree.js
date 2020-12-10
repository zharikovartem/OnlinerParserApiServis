import React, { useState, useEffect } from 'react';
import { Spin, Space, Tree } from 'antd';

const CatalogTree = (props) => {
    // console.log('CatalogTree props: ', props);

    useEffect(() => {
        if (props.catalogTree === null) {
            props.getCatalogTreeThunkCreator();
        }
    }, [])

    const createCatalogTree = () => {

    }
    if (props.catalogTree === null) {
        return (
            <Space size="middle">
                <Spin size="large" />
            </Space>
        );
    } else {
        return (
            <>
            <h3>Дерево каталога Onliner</h3>
            <Tree
                checkable
                // defaultExpandedKeys={['0-0-0', '0-0-1']}
                // defaultSelectedKeys={['0-0-0', '0-0-1']}
                defaultCheckedKeys={props.defaultCheckedKeys}
                // onSelect={onSelect}
                // onCheck={onCheck}
                treeData={props.catalogTree}
            />
            </>
        );
    }
}

export default CatalogTree;