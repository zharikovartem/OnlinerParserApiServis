import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Link, Route, Switch } from 'react-router-dom';
import MainRouter from '../Router';
import Main from './Main';
import ReadMe from './ReadMe';

import 'bootstrap/dist/css/bootstrap.min.css';

function Example() {
    return (
        <div className="container">
            <BrowserRouter>
                <Route component={Main} />
                <Route component={MainRouter} />
            </BrowserRouter>
            <ReadMe />
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
