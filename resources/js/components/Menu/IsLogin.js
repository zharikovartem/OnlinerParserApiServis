import React from 'react';
import { Link } from 'react-router-dom';
import { Navbar, Nav, NavDropdown, Form, FormControl, Button } from 'react-bootstrap';

const IsLogin = (props) => {

    const logout = () => {
        props.logout();
    }

    return (
        <div>
            {/* <span className="nav-link">{props.user.name}
                <Link onClick={logout} to="/login">Выход</Link>
            </span> */}
            <NavDropdown title={props.user.name} id="basic-nav-dropdown">
                <NavDropdown.Item href="#action/3.1">Action</NavDropdown.Item>
                <NavDropdown.Item href="#action/3.2">Another action</NavDropdown.Item>
                <NavDropdown.Item href="#action/3.3">Something</NavDropdown.Item>
                <NavDropdown.Divider />
                <Link className="nav-link" onClick={logout} to="/login">Выход</Link>
            </NavDropdown>
        </div>
    );
}

export default IsLogin;