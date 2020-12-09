import {connect} from 'react-redux';
import Login from './Login';
import {loginThunkCreator} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        // user: state.user
    }
}

export default connect(mapStateToProps, 
    {loginThunkCreator}) 
    (Login);