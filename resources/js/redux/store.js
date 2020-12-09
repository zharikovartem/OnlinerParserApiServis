import { createStore, combineReducers, applyMiddleware } from 'redux';
import userReducer from './userReducer';
import thunkMiddleware from "redux-thunk";


let redusers = combineReducers({
    user: userReducer
});

let store = createStore(redusers, applyMiddleware(thunkMiddleware));

// window.store = store;

export default store;