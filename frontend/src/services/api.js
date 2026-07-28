import axios from 'axios';

const apiClient = axios.create({
    baseURL: (import.meta.env.DEV ? 'http://localhost:8000/' : import.meta.env.BASE_URL) + 'api', 
    timeout: 3000
});

export default apiClient;
