<script setup>
    import IconDelete from '@/components/icons/IconDelete.vue'
    import ListItem from '../layout/ListItem.vue'
    import {dateFormat} from '@/services/datetime'

    import { usePostsStore } from '@/pinia/stores/posts'

    const store = usePostsStore()

    const { post } = defineProps([
        'post'
    ])

    function deletePost(event)
    {
        store.deletePost(new FormData(event.currentTarget.parentElement))
    }

</script>

<template>
    <RouterLink :to="'/post/' + post.id" class="link-reset">
        <ListItem>
            <form class="d-flex flex-jc-sb flex-ai-start" @submit.prevent>
                <input type="hidden" name="id" :value="post.id">
                <span>
                    <div>
                        <strong>{{ post.id }}.</strong>
                        {{ post.text }}
                    </div>
                    <div class="fs-12 c-dark_grey">{{ dateFormat(post.datetime) }}</div>
                </span>
                <button class="svg_button_small" @click.stop="deletePost">
                    <IconDelete></IconDelete>
                </button>
            </form>
        </ListItem>
    </RouterLink>
</template>
