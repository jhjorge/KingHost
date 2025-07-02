<script setup lang="ts">
import MovieCard from "@/components/ui/MovieCard.vue";
import { SliderHome } from "./partials";
import { ref, onMounted, Suspense } from "vue";
import { getPopularMovies } from "@/services/moviesService";
import type { Movie } from "@/types/movie";

const movies = ref<Movie[]>([]);
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await getPopularMovies();
    movies.value = res.data;
  } finally {
    loading.value = false;
  }
});
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
    <div v-if="loading" class="flex justify-center items-center p-20">
      <span class="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900"></span>
    </div>

    <div
      v-else
      class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] sm:grid-cols-[repeat(auto-fit,minmax(280px,1fr))] justify-center gap-6 p-4 md:gap-8 md:p-8 card-container"
    >
      <MovieCard v-for="movie in movies" :key="movie.id" :movie="movie" />
    </div>
  </section>
</template>
<style scoped lang="scss">
.card-container:has(.card:hover) .card:not(:hover) {
  opacity: 0.9;
  transform: scale(0.95);
}
.card {
  transition: all 0.3s ease;
}
</style>
