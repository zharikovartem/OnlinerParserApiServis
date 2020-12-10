import {catalogAPI} from './../api/api';
import {treeMaping} from './../servises/treeMaping'; 
const SET_CATALOG_TREE = 'SET_CATALOG_TREE';

let initialState = {
    catalogTree: null,
};

const productReducer = (state = initialState, action) => {
    let stateCopy= { ...state };
    switch (action.type) {
        case SET_CATALOG_TREE:
            stateCopy.catalogTree = treeMaping.mapingArreyToObject(action.catalogItems);
            return stateCopy;

        default:
            return state;
    }
}

export const setCatalogTree = (catalogItems) => ({ type: SET_CATALOG_TREE, catalogItems });

export const getCatalogTreeThunkCreator = () => {
    return (dispatch) => {
        catalogAPI.getCatalogItems().then(response => {
            console.log(response)
            dispatch(setCatalogTree(response.data));
        });
    }
}


export default productReducer;