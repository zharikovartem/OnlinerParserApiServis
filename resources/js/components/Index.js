import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Link, Route, Switch } from 'react-router-dom';
import MainRouter from '../Router';
import { Provider } from 'react-redux';
import store from './../redux/store';
import ReadMe from './ReadMe';

import 'antd/dist/antd.css';

// const { Header, Footer, Sider, Content } = Layout;

import 'bootstrap/dist/css/bootstrap.min.css';
import Menu from './Menu/MenuContainer';

function Example() {
    return (
        <div className="container-fluid">
            <Provider store={store}>
                <BrowserRouter>

                    <Menu />


                    {/* <Route component={Main} /> */}
                    <Route component={MainRouter} />
                </BrowserRouter>
            </Provider>
            <ReadMe />
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
