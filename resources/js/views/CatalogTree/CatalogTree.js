import React, {useState, useEffect} from 'react';

const CatalogTree = (props) => {
    console.log('CatalogTree props: ', props);

    useEffect(() => {
        if (props.catalogTree === null) {
            props.getCatalogTreeThunkCreator();
        }
    }, [])

    return(
        <div>
            CatalogTree
        </div>
    );
}

export default CatalogTree;