import {catalogAPI} from './../api/api';
import {treeMaping} from '../servises/Tree/treeMaping'; 
const SET_CATALOG_TREE = 'SET_CATALOG_TREE';
const SET_CATALOG_RELOAD = 'SET_CATALOG_RELOAD';

let initialState = {
    catalogTree: null,
    defaultCheckedKeys: [],
    catalogReload: false,
};

const productReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_CATALOG_TREE:
            // const treeData = treeMaping.mapingArreyToObject(action.catalogItems);
            // stateCopy.catalogTree = treeData.tree;
            // stateCopy.defaultCheckedKeys = treeData.defaultCheckedKeys;
            stateCopy.catalogTree = action.catalogItems;
            console.log('catalogTree: ', stateCopy.catalogTree);
            return stateCopy;

        case SET_CATALOG_RELOAD:
            console.log(SET_CATALOG_RELOAD)
            stateCopy.catalogReload = true;
            stateCopy.catalogTree = null;
            return stateCopy;

        default:
            return state;
    }
}

export const setCatalogTree = (catalogItems) => ({ type: SET_CATALOG_TREE, catalogItems });
export const setCatalogReload = () => ({ type: SET_CATALOG_RELOAD });

export const getCatalogTreeThunkCreator = () => {
    return (dispatch) => {
        catalogAPI.getCatalogItems().then(response => {
            dispatch(setCatalogTree(response.data));
        });
    }
}

export const getProductsList = (item) => {
    //////////////////////////////////////////////
        
    //////////////////////////////////////////////
    return (dispatch) => {
        catalogAPI.parseProductsList(item).then(response => {
            // dispatch(setCatalogTree(response.data));
            console.log(response)
        });
    }
}

export const startDescriptionsParse = (item) => {
    return (dispatch) => {
        catalogAPI.startDescriptionsParse(item).then(response => {
            // dispatch(setCatalogTree(response.data));
            console.log(response)
        });
    }
}

export default productReducer;