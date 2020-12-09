import {userAPI} from './../api/api';
const SET_USER_DATA = 'SET_USER_DATA';

let initialState = {
    phone: null,
    password: null,
    name: null,
    userId: null,
    status: null,
    isAuth: false,
    isLoginInProgress: false
};

const userReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_USER_DATA:
            return stateCopy;

        default:
            return state;
    }
}

export const setUser = (userData) => ({ type: SET_USER_DATA, userData });

// export const getAuthMeThunkCreator = () => {
//     return (dispatch) => {
        // dispatch(toggleIsFetching(isFetching: true)); // запускаем спинер
        // userAPI.authMe().then(response => {
        //     dispatch(setUser(response));
        // });
//     }
// }

export const registerThunkCreator = (creds) => {
    return (dispatch) => {
        userAPI.register(creds).then(response => {
            dispatch(setUser(response));
        });
    }
}

export default userReducer;