import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import Posts from '@/views/Posts.vue'
import Post from '@/views/Post.vue'

const routes = [
    { path: '/', name: 'home', component: Home, meta: {title: 'Главная страница'} },
    { path: '/posts', name: 'posts', component: Posts, meta: {title: 'Посты'} },
    { path: '/post/:id', name: 'post', component: Post, meta: {title: 'Пост № '} },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to) => {
    const id = to.params.id ?? ''
    to.meta.title += id
    document.title = to.meta.title;
});

export default router
