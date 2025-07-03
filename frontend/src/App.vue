<script setup lang="ts">
import { RouterView } from "vue-router";
import NavBar from "@/components/layout/NavBar.vue";
import FooterBar from "./components/layout/FooterBar.vue";
</script>

<template>
  <div class="bg-[var(--color-third)]">
    <NavBar />
    <main>
      <RouterView />
    </main>
    <FooterBar />
  </div>
</template>

<style lang="sass" scoped></style>
