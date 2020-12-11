import {connect} from 'react-redux';
import Menu from './Menu';
import {logout, authMeThunkCreator} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        isAuth: state.user.isAuth,
        user: state.user.user,
        userStatus: state.user.userStatus,
    }
}

export default connect(mapStateToProps, 
    {logout, authMeThunkCreator}) 
    (Menu);