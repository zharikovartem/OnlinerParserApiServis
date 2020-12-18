import {connect} from 'react-redux';
import Provider from './Provider';
// import {logout} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        // isAuth: state.user.isAuth,
        // user: state.user.user,
        // userStatus: state.user.userStatus,
    }
}

export default connect(mapStateToProps, 
    {}) 
    (Provider);