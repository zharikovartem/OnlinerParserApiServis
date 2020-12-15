import React, { useState, useEffect } from 'react';
import { Spin, Space, Tree } from 'antd';
import {treeMaping} from '../../servises/Tree/treeMaping'; 

const CatalogTree = (props) => {
    // console.log('CatalogTree props: ', props);

    useEffect(() => {
        if (props.catalogTree === null) {
            props.getCatalogTreeThunkCreator();
        }
    }, [])

    if (props.catalogTree === null) {
        return (
            <Space size="middle">
                <Spin size="large" />
            </Space>
        );
    } else {
        const treeData = treeMaping.mapingArreyToObject(props.catalogTree);
        console.log('treeData: ', treeData)
        return (
            <>
            <h3>Дерево каталога Onliner</h3>
            <Tree
                checkable
                // defaultExpandedKeys={['0-0-0', '0-0-1']}
                // defaultSelectedKeys={['0-0-0', '0-0-1']}
                defaultCheckedKeys={treeData.defaultCheckedKeys}
                // onSelect={onSelect}
                // onCheck={onCheck}
                treeData={treeData.tree}
            />
            </>
        );
    }
}

export default CatalogTree;