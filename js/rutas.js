
const MyApiClient = axios.create({
    baseURL: 'http://localhost:80/laguna/',
    headers: {'Cache-Control': 'no-cache'}
});