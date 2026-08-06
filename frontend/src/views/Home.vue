<script setup>
  import Counter from '@/components/interface/Counter.vue'
  import Container from '@/components/layout/Container.vue'

  import { ref } from 'vue'

  const counterValue = ref(0);

  function updateCounter(newCounterValue)
  {
    counterValue.value = newCounterValue;
  }

</script>

<template>
    <main class="inner">
      <Container>
        
        <template #header_left_el>
          <h2>Счётчик</h2>
        </template>

        <template #default>
          <div class="mb-20">Проверка работы watch и emit. Значение счетчика в родительском компоненте13523: {{ counterValue }}</div>
          <Counter @updateCounter="updateCounter"></Counter>
        </template>

      </Container>
    </main>
</template>
