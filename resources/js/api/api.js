import * as axios from 'axios';

const instanse = axios.create({
    baseURL: window.location.origin,
    withCredentials: true,
    headers: {'Authorization': 'Bearer '+localStorage.getItem('JwcToken')}
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
