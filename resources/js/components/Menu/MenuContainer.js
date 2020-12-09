import {connect} from 'react-redux';
import Menu from './Menu';
// import {loginThunkCreator} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        isAuth: state.user.isAuth,
        user: state.user.user,
    }
}

export default connect(mapStateToProps, 
    {}) 
    (Menu);