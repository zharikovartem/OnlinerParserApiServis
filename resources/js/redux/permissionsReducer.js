import {userAPI} from './../api/api';
const SET_PERMISSIONS = 'SET_PERMISSIONS';

let initialState = {
    permissionType: 'guest',
};

const permissionReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_PERMISSIONS:
            stateCopy = initialState;
            return stateCopy;

        default:
            return state;
    }
}

export const setPermissions = (userData) => ({ type: SET_PERMISSIONS, userData });

// export const getPermissionsThunkCreator = (creds) => {
//     return (dispatch) => {
//         userAPI.register(creds).then(response => {
//             dispatch(setUser(response));
//         });
//     }
// }


export default permissionReducer;