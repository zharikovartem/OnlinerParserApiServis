import React from 'react';
import TreeItem from './TreeItemContainer';

let defaultCheckedKeys = [];

const toAndtTreeType = (object, thisKey, oldKey, Comp = undefined) => {
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
                // console.log('object: ', object)
                let item = {
                    title: Comp===undefined ? key : <Comp elem={ {name: key} } />,
                    key: String(newKey),
                    children: toAndtTreeType(element, 0, newKey, Comp)
                };
                response.push(item)
            } else {
                // console.log('comp: ', Comp)
                let item = {}
                if (Comp === undefined) {
                    // console.log('Comp === undefined: ')
                    item = {
                        // title: element.label,
                        title:  <TreeItem elem={element} />,
                        key: String(newKey),
                    };
                    // console.log(item)
                } else {
                    item = {
                        // title: element.label,
                        title:  <Comp elem={element} />,
                        key: String(newKey),
                    };
                }
                
                if (element.is_active) {
                    defaultCheckedKeys.push(String(newKey));
                }
                // console.log(item)
                response.push(item)
            }
        }
        thisKey++;
    }

    return response;
}

export const treeMaping = {

    mapingArreyToObject(arr, Comp = undefined) {
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
            tree: toAndtTreeType(response, 0, '', Comp),
            defaultCheckedKeys: defaultCheckedKeys
        }
    }
}