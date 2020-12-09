import {connect} from 'react-redux';
import Register from './Register';
import {registerThunkCreator} from './../../redux/userReducer';

let mapStateToProps = (state) => {
    return {
        // user: state.user
    }
}

export default connect(mapStateToProps, 
    {registerThunkCreator}) 
    (Register);