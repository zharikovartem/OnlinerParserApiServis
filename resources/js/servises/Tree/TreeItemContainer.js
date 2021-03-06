import {connect} from 'react-redux';
import TreeItem from './TreeItem';
import {getProductsList, startDescriptionsParse, setCatalogReload} from './../../redux/productReducer';

let mapStateToProps = (state) => {
    // console.log(parseProductsListThunkCreator);
    return {
        isAuth: state.user.isAuth,
        // getProductsList: getProductsList
        // user: state.user.user,
        // userStatus: state.user.userStatus,
    }
}

export default connect(mapStateToProps, 
    {getProductsList, startDescriptionsParse, setCatalogReload}) 
    (TreeItem);