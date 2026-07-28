<script setup>
    import styles from '@/styles/scss/components/Input.module.scss';

    const model = defineModel()
</script>

<template>
    <input :class="styles.input" v-model.number="model"/>
</template>
