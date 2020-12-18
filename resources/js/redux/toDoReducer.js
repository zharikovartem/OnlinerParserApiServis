import {userAPI} from './../api/api';
const SET_TODO_DATA = 'SET_USER_DATA';
const LOGOUT = 'LOGOUT';

let initialState = {
    ToDoData: [],
    // isLoginInProgress: false,
    // user: {},
    // userStatus: 'guest',
};

const userReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_TODO_DATA:
            stateCopy.user = action.userData.data.user;
            stateCopy.isAuth = true;
            if (action.userData.data.user.status !== undefined) {
                stateCopy.userStatus = action.userData.data.user.status;
            }
            return stateCopy;

        // case LOGOUT:
        //     stateCopy = initialState;
        //     localStorage.removeItem('remember_token');
        //     return stateCopy;

        default:
            return state;
    }
}

export const setUser = (toDoData) => ({ type: SET_TODO_DATA, toDoData });