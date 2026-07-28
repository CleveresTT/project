<script setup>
    import styles from '@/styles/scss/components/Container.module.scss';
</script>

<template>
  <section :class="styles.container">
    <header :class="styles.header">
      <slot name="header_left_el"></slot>
      <slot name="header_right_el"></slot>
    </header>
    <slot></slot>
  </section>
</template>
