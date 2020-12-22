import { createStore, combineReducers, applyMiddleware } from 'redux';
import userReducer from './userReducer';
import thunkMiddleware from "redux-thunk";
import permissionReducer from './permissionsReducer';
import productReducer from './productReducer';
import toDoReducer from './toDoReducer';


let redusers = combineReducers({
    user: userReducer,
    permissions: permissionReducer,
    products: productReducer,
    toDo: toDoReducer,
});

let store = createStore(redusers, applyMiddleware(thunkMiddleware));

// window.store = store;

export default store;