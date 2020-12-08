import { createStore, combineReducers, applyMiddleware } from 'redux';
import userReducer from './userReducer';


let rducers = combineReducers({
    user: userReducer
});

let store = createStore(redusers, applyMiddleware(thunkMiddleware));

// window.store = store;

export default store;