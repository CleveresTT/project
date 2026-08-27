import { createApp } from 'vue'

import router from '@/router/index'
import pinia from '@/pinia/index'

import './styles/style.scss'
import App from './App.vue'

import apiClient from '@/services/api'

apiClient.interceptors.request.use((config) => {
    document.getElementById('loader_fullscreen').style.display = 'flex';
    return config;
});
  
apiClient.interceptors.response.use((response) => {
    document.getElementById('loader_fullscreen').style.display = 'none';
    return response;
});

import VueAwesomePaginate from "vue-awesome-paginate";
import "vue-awesome-paginate/dist/style.css";

createApp(App)
    .use(router)
    .use(pinia)
    .use(VueAwesomePaginate)
    .mount('#app')
