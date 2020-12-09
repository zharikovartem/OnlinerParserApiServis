import React from 'react';
import {BrowserRouter, Link, Route, Switch} from 'react-router-dom';
import Login from './views/Login/LoginContainer';
import RegisterContainer from './views/Register/RegisterContainer ';
// User is LoggedIn
import Main from './components/Main';

const MainRouter = props => (
<Switch>
  {/*User might LogIn*/}
  <Route exact path='/' component={Main}/>
  
  {/*User will LogIn*/}
  <Route path='/login' component={Login}/>
  <Route path='/registration' component={RegisterContainer}/>
  {/* User is LoggedIn*/}
  {/* <PrivateRoute path='/dashboard' component={Dashboard}/> */}
  {/*Page Not Found*/}
  {/* <Route component={NotFound}/> */}
</Switch>
);

export default MainRouter;