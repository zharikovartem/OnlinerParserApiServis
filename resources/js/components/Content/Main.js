import React from 'react';
import ReadMe from '../../views/ReadMe/ReadMe';
import { Tabs } from 'antd';
import CatalogTree from '../../views/CatalogTree/CatalogTreeContainer';
import ToDo from './ToDo/ToDoContainer';
// import ToDo from './../Todo/ToDoList';
import Client from './Client/Client';
import Providers from './Providers/ProvidersContainer';
import Orders from './Orders/Orders';
import ToDoList from './../Todo/ToDoListContainer';

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
                    <TabPane tab="Заказы" key="4">
                        <Orders />
                    </TabPane>
                    <TabPane tab="ToDo" key="5">

                        {/* <ToDo /> */}
                        <ToDoList />

                    </TabPane>
                    <TabPane tab="ReadMe" key="6">
                        <ReadMe />
                    </TabPane>
                    <TabPane tab="Процессы" key="7">
                        <Client />
                    </TabPane>
                    <TabPane tab="Почта" key="8">
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