<script setup>
    import styles from '@/styles/scss/components/List.module.scss';
    const props = defineProps([
        'direction',
        'filler'
    ])

    const direction = props.direction == 'col' ? styles['list--col'] : '';
    const filler = props.filler ? styles['list--filler'] : '';

    const classNames = [styles.list, filler, direction].join(' ');


</script>

<template>
    <ul :class="classNames">
        <slot></slot>
    </ul>
</template>
