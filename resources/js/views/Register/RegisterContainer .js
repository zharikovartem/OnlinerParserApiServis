import {connect} from 'react-redux';
import Register from './Register';
import {registerThunkCreator} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        isAuth: state.user.isAuth,
    }
}

export default connect(mapStateToProps, 
    {registerThunkCreator}) 
    (Register);