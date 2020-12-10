import * as axios from 'axios';

const instanse = axios.create({
    baseURL: window.location.origin,
    withCredentials: true,
    headers: { 'Authorization': 'Bearer ' + localStorage.getItem('JwcToken') }
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
                console.log(response)
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

    authMe(token) {
        // console.log('remember_token: ', localStorage.getItem('remember_token'))
        return instanse.get('api/authMe/' + localStorage.getItem('remember_token'))
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
    }
}
