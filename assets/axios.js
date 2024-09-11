import axios from 'axios';

const instance = axios.create({
  baseURL: 'http://todo.loc/api/task',
  timeout: 1000,
});

export default instance;
