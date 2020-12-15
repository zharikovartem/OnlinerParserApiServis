import {connect} from 'react-redux';
import CatalogTree from './CatalogTree';
import {getCatalogTreeThunkCreator} from './../../redux/productReducer';

let mapStateToProps = (state) => {
    return {
        isAuth: state.user.isAuth,
        catalogTree: state.products.catalogTree,
        // defaultCheckedKeys: state.products.defaultCheckedKeys,
    }
}

export default connect(mapStateToProps, 
    {getCatalogTreeThunkCreator}) 
    (CatalogTree);