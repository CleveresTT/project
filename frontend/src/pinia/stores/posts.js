import { defineStore } from 'pinia'
import apiClient from '@/services/api';
import { nextTick } from 'vue';

export const usePostsStore = defineStore('posts', {
    state: () => ({ 
        posts: []
    }),
    getters: {
        postsLength: (state) => state.posts.length,
    },
    actions: {

        setPostsNextTick(data) {
            nextTick(()=>{
              this.posts = data
            })
        },

        async makePost (formdata) {
            this.posts = apiClient
                .post('/posts/make_post', formdata)
                .then(response => {
                    this.setPostsNextTick(response.data)
                })
        },

        async deletePost (formdata) {
            this.posts = apiClient
                .post('/posts/delete_post', formdata)
                .then(response => {
                    this.setPostsNextTick(response.data)
                })
        },

        async setPosts() {
            this.posts = apiClient
                .get('/posts/get_posts')
                .then(response => {
                    this.setPostsNextTick(response.data)
                })
        },

        async getPostById (id) {
            return apiClient
                .get(`/posts/get_post/${id}`)
                .then(response => response.data)
        },
    },
})
