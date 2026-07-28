<script setup>
    import Button from '@/components/form/Button.vue'
    import Input from '@/components/form/Input.vue'
    import { ref, watch } from 'vue'

    const counterValue = ref(0);

    function counterIncrement () {
        counterValue.value++;
    }

    function counterDecrement () {
        counterValue.value--;
    }

    const emit = defineEmits([
        'updateCounter'
    ])

    watch(counterValue, (newVal)=>{
        emit('updateCounter', newVal);
    })

</script>

<template>
    <div class="d-flex g-16 h-50">
        <Button class="fs-28 ar-1-1" @click="counterDecrement">-</Button>
        <Input class="w-100" v-model="counterValue"></Input>
        <Button class="fs-28 ar-1-1" @click="counterIncrement">+</Button>
    </div>
</template>