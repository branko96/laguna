
const MyApiClient = axios.create({
    baseURL: 'http://localhost:80/laguna/',
    headers: {'X-Custom-Header': 'foobar'}
});