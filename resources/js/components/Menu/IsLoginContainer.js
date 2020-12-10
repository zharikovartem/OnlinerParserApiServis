import {connect} from 'react-redux';
import IsLogin from './IsLogin';
import {logout} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        isAuth: state.user.isAuth,
        user: state.user.user,
    }
}

export default connect(mapStateToProps, 
    {logout}) 
    (IsLogin);