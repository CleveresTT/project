
<script setup>
    import styles from '@/styles/scss/views/Post.module.scss';
    import Container from '@/components/layout/Container.vue';
    import { useRoute } from 'vue-router'
    import { usePostsStore } from '@/pinia/stores/posts'
    import { ref } from 'vue'
    import {dateFormat} from '@/services/datetime'

    const route = useRoute()

    let id = ref(0)
    let text = ref('')
    let datetime = ref('')

    const store = usePostsStore()
    store.getPostById(route.params.id)
        .then(data => {
            id.value = data.id
            text.value = data.text
            datetime.value = dateFormat(data.datetime)
        })

</script>

<template>
    <main class="inner">
        <Container>

            <template #header_left_el>
                <h2>{{ id ? 'ID: ' + id : 'Пост не найден' }}</h2>
            </template>

            <template #header_right_el>
                <RouterLink to="/posts">Назад</RouterLink>
            </template>

            <template #default>
                <div v-if="id && text && datetime" :class="styles.post">
                    <p>{{ text }}</p>
                    <div class="c-dark_grey fs-12">Создано: {{ datetime }}</div>
                </div>
            </template>

        </Container>
    </main>
</template>
