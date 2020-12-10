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
                                response[key][element2][nameByLabel[element3]] = itemsByNmae[element3];
                            }
                        }
                    }
                }
            }
        }
        return response;
    }
}