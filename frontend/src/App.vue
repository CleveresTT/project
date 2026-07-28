<script setup>
    import Header from './components/layout/Header.vue';
</script>

<template>
    <Header></Header>

    <hr/>
    <br/>

    <RouterView></RouterView>

    <div id="loader_fullscreen">
        <img src="./assets/svg/loader.svg" alt="">
    </div>
</template>
