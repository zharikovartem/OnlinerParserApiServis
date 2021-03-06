import * as axios from 'axios';

const instanse = axios.create({
    baseURL: window.location.origin,
    withCredentials: true,
    headers: { 
        'X-Auth-Token' : localStorage.getItem('remember_token')
    }
});

axios.defaults.withCredentials = true;

export const userAPI = {

    register(data) {
        return instanse.post('api/register', data)
            .then(response => {
                console.log(response)
                return response.status === 200 ? response : null;
            })
            .catch(err => {
                if (err.response) {
                    console.log(err.response.data)
                    return err.response.data
                } else if (err.request) {
                    console.log('request', err.request)
                } else {
                    console.log('anything else: ', err)
                }
                return null
            })
    },

    login(data) {
        return instanse.post('api/login', data)
            .then(response => {
                console.log('api/login: ', response)
                if (response.data.remember_token !== null) {
                    localStorage.setItem('remember_token', response.data.remember_token);
                } else {
                    localStorage.removeItem('remember_token');
                }
                return response.status === 200 ? response : null;
            })
            .catch(err => {
                if (err.response) {
                    console.log(err.response.data)
                    return err.response.data
                } else if (err.request) {
                    console.log('request', err.request)
                } else {
                    console.log('anything else: ', err)
                }
                return null
            })
    },

    authMe() {
        // console.log('remember_token: ', localStorage.getItem('remember_token'))
        return instanse.get('api/authMe/'+localStorage.getItem('remember_token'))
            .then(response => {
                // console.log('auth/me: ', response);
                return response
            })
            .catch(err => {
                if (err.response) {
                    console.log('response', err.response.data.message)
                    return err.response.data
                } else if (err.request) {
                    console.log('request', err.request)
                } else {
                    console.log('anything else ')
                }
                return null
            })
    },

    logout() {

    }
}

export const catalogAPI = {
    getCatalogItems() {
        return instanse.get('api/getCatalogParts')
            .then(response => {
                return response.status === 200 ? response : null;
            })
            .catch(err => {
                if (err.response) {
                    console.log(err.response.data)
                    return err.response.data
                } else if (err.request) {
                    console.log('request', err.request)
                } else {
                    console.log('anything else: ', err)
                }
                return null
            })
    }, 

    parseProductsList(productType) {
        return instanse.get('api/startCatalogItem/'+productType)
            .then(response => {
                return response.status === 200 ? response : null;
            })
    }, 

    startDescriptionsParse(productType) {
        console.log('api/startProductParamParsing/',productType)
        return instanse.get('api/startProductParamParsing/'+productType)
            .then(response => {
                return response.status === 200 ? response : null;
            })
    }
}

export const toDoAPI = {
    getToDoList(data) {
        return instanse.get('api/tasks?date='+data)
            .then(response => {
                console.log('getToDoList', response)
                return response.status === 200 ? response : null;
            })
            // .catch(err => {
            //     if (err.response) {
            //         console.log(err.response.data)
            //         return err.response.data
            //     } else if (err.request) {
            //         console.log('request', err.request)
            //     } else {
            //         console.log('anything else: ', err)
            //     }
            //     return null
            // })
    },

    editToDoItem(data) {
        return instanse.post('api/getToDoList', data)
            .then(response => {
                console.log(response)
                return response.status === 200 ? response : null;
            })
    },

    createNewTask(data) {
        return instanse.post('api/tasks', data)
            .then(response => {
                console.log('createNewTask',response)
                return response.status === 200 ? response : null;
            })
            .catch(err => {
                if (err.response) {
                    console.log(err.response.data)
                    return err.response.data
                } else if (err.request) {
                    console.log('request', err.request)
                } else {
                    console.log('anything else: ', err)
                }
                return null
            })
    }
}

