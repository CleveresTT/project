<script setup>
    import Container from '@/components/layout/Container.vue'
    import List from '@/components/layout/List.vue'
    import ListItemPost from '@/components/posts/ListItemPost.vue'
    import Textarea from '@/components/form/Textarea.vue'
    import Button from '@/components/form/Button.vue'
    import Pagination from '@/components/interface/Pagination.vue'
    import { ref, computed } from "vue";

    import { usePostsStore } from '@/pinia/stores/posts'
    import { storeToRefs } from 'pinia'

    const store = usePostsStore()
    const { posts, postsLength } = storeToRefs(store)

    function makePost(event)
    {
        const textarea = event.currentTarget.firstChild
        
        store.makePost(new FormData(event.currentTarget))
            .then(()=>{
                textarea.value = '';
            })
    }

    const currentPage = ref(1)
    const itemsPerPage = 5
    const maxPagesShown = 2

    const displayedPosts = computed(() => 
      posts.value.slice(
        (currentPage.value - 1) * itemsPerPage,
        (currentPage.value * itemsPerPage)
      )
    )

</script>

<template>
    <main class="inner d-flex flex-ai-start flex-wrap g-16">
      <Container>

        <template #header_left_el>
          <h2>Введите текст поста</h2>
        </template>

        <template #default>
          <form class="d-flex flex-dir-col flex-ai-end g-16" @submit.prevent="makePost">
            <Textarea class="w-100-p" placeholder="Введите текст поста" name="text"/>
            <Button>Отправить</Button>
          </form>
        </template>

      </Container>

      <Container>

        <template #header_left_el>
          <h2>Текущие посты</h2>
        </template>

        <template #header_right_el>
          <Pagination 
            :totalItems="postsLength"      
            :itemsPerPage="itemsPerPage"
            :max-pages-shown="maxPagesShown"
            v-model="currentPage"
          >
          </Pagination>
        </template>

        <template #default>
          <div v-if="postsLength">
            <List :direction="'col'">
              <ListItemPost v-for="post in displayedPosts" :key="post.id" :post="post">
              </ListItemPost>
            </List>
            
          </div>
          <span v-else class="text-align-top">Постов нет</span>
        </template>

      </Container>
    </main>
</template>
