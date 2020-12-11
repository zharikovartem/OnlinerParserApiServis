import {catalogAPI} from './../api/api';
import {treeMaping} from '../servises/Tree/treeMaping'; 
const SET_CATALOG_TREE = 'SET_CATALOG_TREE';

let initialState = {
    catalogTree: null,
    defaultCheckedKeys: [],
};

const productReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_CATALOG_TREE:
            const treeData = treeMaping.mapingArreyToObject(action.catalogItems);
            stateCopy.catalogTree = treeData.tree;
            stateCopy.defaultCheckedKeys = treeData.defaultCheckedKeys;
            console.log('catalogTree: ', stateCopy.catalogTree);
            return stateCopy;

        default:
            return state;
    }
}

export const setCatalogTree = (catalogItems) => ({ type: SET_CATALOG_TREE, catalogItems });

export const getCatalogTreeThunkCreator = () => {
    return (dispatch) => {
        catalogAPI.getCatalogItems().then(response => {
            dispatch(setCatalogTree(response.data));
        });
    }
}

export const getProductsList = (item) => {
    return (dispatch) => {
        catalogAPI.parseProductsList(item).then(response => {
            // dispatch(setCatalogTree(response.data));
            console.log(response)
        });
    }
}

export default productReducer;