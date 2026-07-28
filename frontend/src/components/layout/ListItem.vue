<script setup>
    import styles from '@/styles/scss/components/ListItem.module.scss';
</script>

<template>
    <li :class="styles.list__item">
        <slot></slot>
    </li>
</template>
