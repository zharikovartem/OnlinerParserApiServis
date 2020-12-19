import React from 'react';
import ReadMe from '../../views/ReadMe/ReadMe';
import { Tabs } from 'antd';
import CatalogTree from '../../views/CatalogTree/CatalogTreeContainer';
import ToDo from './ToDo/ToDo';
import Client from './Client/Client';
import Providers from './Providers/ProvidersContainer';

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
                    <TabPane tab="Поставщики" key="3">
                        <Providers />
                    </TabPane>
                    <TabPane tab="ToDo" key="4">
                        <ToDo />
                    </TabPane>
                    <TabPane tab="ReadMe" key="5">
                        <ReadMe />
                    </TabPane>
                    <TabPane tab="Процессы" key="6">
                        <Client />
                    </TabPane>
                    <TabPane tab="Почта" key="7">
                        Почта
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
        } else if (props.userStatus === 'client') {
            return (
                <div>CATALOG for guest when auth as client</div>
            );
        }

    } else {
        return (
            <div>CATALOG</div>
        );
    }

}

export default Main;