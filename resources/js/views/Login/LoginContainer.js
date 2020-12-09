import {connect} from 'react-redux';
import Login from './Login';
import {loginThunkCreator} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        isAuth: state.user.isAuth,
    }
}

export default connect(mapStateToProps, 
    {loginThunkCreator}) 
    (Login);