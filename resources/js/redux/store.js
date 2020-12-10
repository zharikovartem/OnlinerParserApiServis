import { createStore, combineReducers, applyMiddleware } from 'redux';
import userReducer from './userReducer';
import thunkMiddleware from "redux-thunk";
import permissionReducer from './permissionsReducer';
import productReducer from './productReducer';


let redusers = combineReducers({
    user: userReducer,
    permissions: permissionReducer,
    products: productReducer,
});

let store = createStore(redusers, applyMiddleware(thunkMiddleware));

// window.store = store;

export default store;