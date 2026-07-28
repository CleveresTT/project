<script setup>
    import List from '@/components/layout/List.vue'
    import { useRoute, useRouter } from 'vue-router'
    import { usePostsStore } from '@/pinia/stores/posts';
    import { storeToRefs } from 'pinia';

    const router = useRouter()
    const route = useRoute()

    const store = usePostsStore()
    const { postsLength } = storeToRefs(store)
    store.setPosts()

</script>

<template>
    <header class="d-flex flex-center flex-dir-col mt-20 mb-20">
      <h1>{{ route.meta.title }}</h1>
      <nav>
        <List :filler="true">
          <li v-for="routeInList in router.getRoutes().filter(route => !route.path.includes(':'))"> <!-- исключить роуты с параметрами -->
            <RouterLink :to="routeInList.path">{{ routeInList.meta.title }} {{ routeInList.name == 'posts' ? `(${postsLength})` : '' }}</RouterLink>
          </li>
        </List>
      </nav>
    </header>
</template>
