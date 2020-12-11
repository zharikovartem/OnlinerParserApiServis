import {userAPI} from './../api/api';
const SET_USER_DATA = 'SET_USER_DATA';
const LOGOUT = 'LOGOUT';

let initialState = {
    isAuth: false,
    isLoginInProgress: false,
    user: {},
    userStatus: 'guest',
};

const userReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_USER_DATA:
            stateCopy.user = action.userData.data.user;
            stateCopy.isAuth = true;
            if (action.userData.data.user.status !== undefined) {
                stateCopy.userStatus = action.userData.data.user.status;
            }
            return stateCopy;

        case LOGOUT:
            stateCopy = initialState;
            localStorage.removeItem('remember_token');
            return stateCopy;

        default:
            return state;
    }
}

export const setUser = (userData) => ({ type: SET_USER_DATA, userData });
export const logout = () => ({type: LOGOUT});

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

export const loginThunkCreator = (creds) => {
    return (dispatch) => {
        userAPI.login(creds).then(response => {
            if (response) {
                dispatch(setUser(response));
            } else {
                alert('ERROR!');
            }
            
        });
    }
}

export const authMeThunkCreator = () => {
    return (dispatch) => {
        const JwcToken = localStorage.getItem('remember_token');
        if (JwcToken) {
            userAPI.authMe().then(response => {
                console.log('authMe() in Reducer -> response: ', response.data)
                // if (response.data.error === undefined) {
                //     dispatch(updateUserData(response.data));
                dispatch(setUser(response));    
                // }
                // сохраняем ответ с сервера
            });
        }
    }
}

export default userReducer;