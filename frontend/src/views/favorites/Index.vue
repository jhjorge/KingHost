<script setup lang="ts">
import { computed, ref } from "vue";
import MovieCard from "@/components/ui/MovieCard.vue";
import { useFavoritesStore } from "@/stores/favorites";

const favoritesStore = useFavoritesStore();

const movies = computed(() => favoritesStore.getItems);
</script>

<template>
  <section class="container mx-auto py-6 px-4 min-h-[75dvh] h-full">
    <h1 class="text-white text-5xl font-semibold mb-6">Meus Favoritos</h1>

    <div v-if="movies.length > 0">
      <div
        class="grid p-6 grid-cols-[repeat(auto-fit,minmax(200px,1fr))] sm:grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-8 card-container"
      >
        <MovieCard v-for="movie in movies" :key="movie.id" :movie="movie" class="card" />
      </div>
    </div>

    <div
      v-else
      class="text-center place-content-center font-medium text-2xl text-white min-h-[68dvh]"
    >
      <p>Nenhum conteúdo encontrado nos favoritos 😢</p>
    </div>
  </section>
</template>

<style scoped lang="scss">
.card-container:has(.card:hover) .card:not(:hover) {
  opacity: 0.9;
  transform: scale(0.95);
}
.card {
  transition: all 0.3s ease-in-out;
}
</style>
