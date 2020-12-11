import React, {useEffect} from 'react';
import { Navbar, Nav, NavDropdown, Form, FormControl, Button } from 'react-bootstrap';
import {Link} from 'react-router-dom';
import IsLoginContainer from './IsLoginContainer';

const Menu = (props) => {
    // console.log('Menu props: ', props);
    useEffect(() => {
        if (props.isAuth === false) {
            props.authMeThunkCreator();
        }
    }, [])

    return( 
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
                            <div className="mr-sm-2">
                                {props.isAuth ?
                                    <IsLoginContainer />
                                    :
                                    <Link className="nav-link" to="/login">Login</Link>
                                }
                                
                            </div>
                        </Navbar.Collapse>
                    </Navbar>
    );
}

export default Menu;