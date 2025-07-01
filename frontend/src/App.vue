<script setup lang="ts">
import { RouterView } from "vue-router";
import NavBar from "@/components/layout/NavBar.vue";
import FooterBar from "./components/layout/FooterBar.vue";
</script>

<template>
  <div class="">
    <NavBar />
    <main>
      <RouterView />
    </main>
    <FooterBar />
  </div>
</template>

<style lang="sass" scoped>
.teste
  color: red
  font-weight: bold
</style>
