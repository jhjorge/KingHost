<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>
  <header class="teste">      
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
  </header>

  <RouterView />
</template>

<style lang="sass" scoped>
.teste 
  color: red
  font-weight: bold

</style>
