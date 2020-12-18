import React, { useState, useEffect } from 'react';
import { Spin, Space, Tree } from 'antd';
import {treeMaping} from '../../servises/Tree/treeMaping'; 
import { map } from 'lodash';

const CatalogTree = (props) => {
    console.log('CatalogTree props: ', props);
    const [expandedKeys, setExpandedKeys] = useState([]);

    const onExpand = expandedKeys => {
        console.log('onExpand', expandedKeys);
        // if not set autoExpandParent to false, if children expanded, parent can not collapse.
        // or, you can remove all expanded children keys.
        setExpandedKeys(expandedKeys);
        // setAutoExpandParent(false);
      };

    // let treeData = [];

    useEffect(() => {
        console.log('useEffect')
        if (props.catalogTree === null) {
            props.getCatalogTreeThunkCreator();
        }
        
    }, [props.catalogTree])

    const getActivData = (data) => {
        let check = {};
        let resp = data.map( (item) => {
            if (item.is_active) {
                if (!check[item.name]) {
                    check[item.name] = true;
                    return( <div>{item.label}({item.total_count})/({item.descriptions_count})</div>)
                }
                
            }
        })
        return resp;
    }

    if (props.catalogTree === null) {
        return (
            <Space size="middle">
                <Spin size="large" />
            </Space>
        );
    } else {
        const treeData = treeMaping.mapingArreyToObject(props.catalogTree);
        const activData = getActivData(props.catalogTree);

        console.log('treeData: ', treeData)
        return (
            <>
                <h3>Дерево каталога Onliner</h3>
                <Tree
                    checkable
                    defaultExpandedKeys={expandedKeys}
                    onExpand={onExpand}
                    // defaultSelectedKeys={['0-0-0', '0-0-1']}
                    defaultCheckedKeys={treeData.defaultCheckedKeys}
                    // onSelect={onSelect}
                    // onCheck={onCheck}
                    treeData={treeData.tree}
                />
                <h3>Активные разделы</h3>
                {activData}
            </>
        );
    }
}

export default CatalogTree;