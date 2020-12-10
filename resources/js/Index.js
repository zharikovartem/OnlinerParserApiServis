import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route } from 'react-router-dom';
import MainRouter from './Router';
import { Provider } from 'react-redux';
import store from './redux/store';

import 'antd/dist/antd.css';

import 'bootstrap/dist/css/bootstrap.min.css';
import Menu from './components/Menu/MenuContainer';

const Example = () => {
    console.log(store)
    return (
        <div className="container-fluid">
            <Provider store={store}>
                <BrowserRouter>
                    <Menu />
                    {/* <Route component={Main} /> */}
                    <Route component={MainRouter} />
                </BrowserRouter>
            </Provider>
            {/* <ReadMe /> */}
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
