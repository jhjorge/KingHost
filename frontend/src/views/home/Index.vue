<script setup lang="ts">
import MovieCard from "@/components/ui/MovieCard.vue";
import { SliderHome } from "./partials";
</script>
<template>
  <section class="">
    <SliderHome />
  </section>

  <section class="container mx-auto overflow-hidden py-6">
    <form
      role="search"
      aria-label="Buscar filmes no site"
      @submit.prevent
      class="flex justify-center"
    >
      <label for="site-search" class="sr-only">Buscar filmes no site</label>
      <input
        type="search"
        id="site-search"
        name="q"
        placeholder="Estou buscando por..."
        autocomplete="off"
        class="border border-gray-300 rounded-md px-4 py-2 w-full max-w-md focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"
      />
    </form>
    <div
      class="grid grid-cols-[repeat(auto-fill,minmax(180px,1fr))] sm:grid-cols-[repeat(auto-fill,minmax(300px,1fr))] justify-center gap-6 p-4 md:gap-8 md:p-8"
    >
      <MovieCard v-for="i in 10" />
    </div>
  </section>
</template>
<style></style>
