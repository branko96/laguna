import axios from 'vue-axios.min';

export const MyApiClient = axios.create({
  baseURL: 'https://localhost/laguna/',
  timeout: 1000,
  headers: {'X-Custom-Header': 'foobar'}
});