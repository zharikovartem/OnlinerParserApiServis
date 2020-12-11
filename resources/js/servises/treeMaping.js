import React from 'react';

let defaultCheckedKeys = [];

const TreeItem = (props) => {

    return(
        <div>
            {props.name}
            {/* <button>getItems</button> */}
        </div>
    );
}

const toAndtTreeType = (object, thisKey, oldKey) => {
    let response = [];

    for (const key in object) {
        if (object.hasOwnProperty(key)) {
            const element = object[key];

            let newKey = thisKey;
            if (oldKey !== '') {
                newKey = oldKey+'-'+thisKey;
            }
            // console.log(String(newKey));
            
            if (element.id == undefined) {
                let item = {
                    title: key,
                    key: String(newKey),
                    children: toAndtTreeType(element, 0, newKey)
                };
                response.push(item)
            } else {
                let item = {
                    // title: element.label,
                    title: <TreeItem name={element.label} />,
                    key: String(newKey),
                };
                if (element.is_active) {
                    defaultCheckedKeys.push(String(newKey));
                }
                response.push(item)
            }
        }
        thisKey++;
    }

    return response;
}

export const treeMaping = {

    mapingArreyToObject(arr) {
        let response = {};
        let elemsByParent = {};
        let nameByLabel = {};
        let itemsByNmae = {}
        // 1
        for (let i = 0; i < arr.length; i++) {
            let item = arr[i];
            if (item.parent_id !== 0) {
                if (elemsByParent[item.parent_id] === undefined) {
                    elemsByParent[item.parent_id]={};
                }
                elemsByParent[item.parent_id][item.id] = item.name;
                
            } else {
                response[item.name] = item.id
            }
            nameByLabel[item.name] = item.label
            itemsByNmae[item.name] = item;
        }

        for (const key in response) {
            if (response.hasOwnProperty(key)) {
                const element = response[key];
                response[key] = {};
                for (const key2 in elemsByParent[element]) {
                    if (elemsByParent[element].hasOwnProperty(key2)) {
                        const element2 = elemsByParent[element][key2];
                        response[key][element2] = {}
                        for (const key3 in elemsByParent[key2]) {
                            if (elemsByParent[key2].hasOwnProperty(key3)) {
                                const element3 = elemsByParent[key2][key3];
                                // response[key][element2][nameByLabel[element3]] = <TreeItem name={itemsByNmae[element3]} />;
                                response[key][element2][nameByLabel[element3]] = itemsByNmae[element3];
                            }
                        }
                    }
                }
            }
        }
        console.log('response: ', response)
        // return toAndtTreeType(response, 0, '');
        return {
            tree: toAndtTreeType(response, 0, ''),
            defaultCheckedKeys: defaultCheckedKeys
        }
    }
}