<script setup>
import styles from '@/styles/scss/components/Button.module.scss';
</script>

<template>
    <button :class="styles.button">
        <slot></slot>
    </button>
</template>
