import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Link, Route, Switch } from 'react-router-dom';
import MainRouter from '../Router';
import Main from './Main';
import ReadMe from './ReadMe';

import 'antd/dist/antd.css';
import { Navbar, Nav, NavDropdown, Form, FormControl, Button } from 'react-bootstrap';
// const { Header, Footer, Sider, Content } = Layout;

import 'bootstrap/dist/css/bootstrap.min.css';

function Example() {
    return (
        <div className="container">
            <BrowserRouter>

                <Navbar bg="light" expand="lg">
                    <Navbar.Brand href="/">ArtCRM</Navbar.Brand>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="mr-auto">
                            <Link className="nav-link" to="/">Home</Link>
                            <Nav.Link href="/link">Link</Nav.Link>
                            <NavDropdown title="Dropdown" id="basic-nav-dropdown">
                                <NavDropdown.Item href="#action/3.1">Action</NavDropdown.Item>
                                <NavDropdown.Item href="#action/3.2">Another action</NavDropdown.Item>
                                <NavDropdown.Item href="#action/3.3">Something</NavDropdown.Item>
                                <NavDropdown.Divider />
                                <NavDropdown.Item href="#action/3.4">Separated link</NavDropdown.Item>
                            </NavDropdown>
                        </Nav>
                        <div inline="true" className="mr-sm-2">
                            <Link className="nav-link" to="/login">Login</Link>
                        </div>
                    </Navbar.Collapse>
                </Navbar>


                {/* <Route component={Main} /> */}
                <Route component={MainRouter} />
            </BrowserRouter>

        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
