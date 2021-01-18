import {toDoAPI} from './../api/api';
const SET_TODO_DATA = 'SET_TODO_DATA';

let initialState = {
    ToDoData: [],
    // isLoginInProgress: false,
    // user: {},
    // userStatus: 'guest',
};

const toDoReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_TODO_DATA:
            console.log(action)
            stateCopy.ToDoData = action.toDoData.data.ToDoList;
            // stateCopy.isAuth = true;
            // if (action.userData.data.user.status !== undefined) {
            //     stateCopy.userStatus = action.userData.data.user.status;
            // }
            return stateCopy;

        // case LOGOUT:
        //     stateCopy = initialState;
        //     localStorage.removeItem('remember_token');
        //     return stateCopy;

        default:
            return state;
    }
}

export const setToDoList = (toDoData) => ({ type: SET_TODO_DATA, toDoData });

export const getToDoList = () => {
    return (dispatch) => {
        toDoAPI.getToDoList().then(response => {
            dispatch(setToDoList(response));
        });
    }
}

export const createNewTask = (data) => {
    return (dispatch) => {
        toDoAPI.createNewTask(data).then(response => {
            dispatch(setToDoList(response));
        })
    }
}

export default toDoReducer;