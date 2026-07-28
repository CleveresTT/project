<script setup>
    import styles from '@/styles/scss/components/Pagination.module.scss';
    import { computed } from 'vue';

    const props = defineProps([
        'totalItems',
        'itemsPerPage'
    ])

    const hidePrevNext = computed(() => (props.totalItems ?? 0) < props.itemsPerPage)

</script>

<template>
  <vue-awesome-paginate
    :class="styles.pagination"

    :total-items="props.totalItems ?? 0"
    :items-per-page="props.itemsPerPage"
    :hide-prev-next="hidePrevNext"
    :hide-prev-next-when-ends="true"
    :active-page-class="styles.active"
  />
</template>
