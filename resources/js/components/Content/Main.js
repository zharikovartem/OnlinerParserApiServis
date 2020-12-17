import React from 'react';
import ReadMe from '../../views/ReadMe/ReadMe';
import { Tabs } from 'antd';
import CatalogTree from '../../views/CatalogTree/CatalogTreeContainer';
import ToDo from './ToDo/ToDo';

const { TabPane } = Tabs;

const Main = (props) => {
    // console.log('Main props: ', props);

    const callback = (key) => {
        // console.log(key);
    }

    if (props.isAuth) {
        if (props.userStatus === 'superAdmin') {
            return (
                // 
                <Tabs defaultActiveKey="1" onChange={callback}>
                    <TabPane tab="Users" key="1">
                        Content of Tab Pane 1
                    </TabPane>
                    <TabPane tab="Catalog" key="2">
                        <CatalogTree />
                    </TabPane>
                    <TabPane tab="ToDo" key="3">
                        <ToDo />
                    </TabPane>
                    <TabPane tab="ReadMe" key="4">
                        <ReadMe />
                    </TabPane>
                    <TabPane tab="Процессы" key="5">
                        Процессы
                    </TabPane>
                </Tabs>
            );
        } else if (props.userStatus === 'guest') {
            return (
                <div>CATALOG for guest when auth as guest</div>
            );
        } else if (props.userStatus === 'diller') {
            return (
                <div>CATALOG for guest when auth as diller</div>
            );
        } else if (props.userStatus === 'lead') {
            return (
                <div>CATALOG for guest when auth as lead</div>
            );
        }

    } else {
        return (
            <div>CATALOG</div>
        );
    }

}

export default Main;