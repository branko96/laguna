
const MyApiClient = axios.create({
    baseURL: 'http://localhost:80/PerroSoft/lagunacampo/',
    headers: {'X-Custom-Header': 'foobar'}
});