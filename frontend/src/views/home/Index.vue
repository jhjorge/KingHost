<script setup lang="ts">
import { ref, onMounted, reactive } from "vue";
import MovieCard from "@/components/ui/MovieCard.vue";
import { SliderHome } from "./partials";
import {
  getPopularMovies,
  getNowPlayingMovies,
  getTopRatedMovies,
  getUpcomingMovies,
} from "@/services/moviesService";
import type { Movie } from "@/types/movie";
import Pagination from "@/components/ui/Pagination.vue";
import SkeletonCard from "@/components/ui/SkeletonCard.vue";
import SecondaryButton from "@/components/ui/buttons/SecondaryButton.vue";

const movies = ref<Movie[]>([]);
const loading = ref(true);
const currentPage = ref(1);
const totalPages = ref(1);

type MovieCategory = "popular" | "now_playing" | "top_rated" | "upcoming";
const currentCategory = ref<MovieCategory>("popular");
const categoryList: { title: string; link: MovieCategory }[] = reactive([
  {
    title: "Populares",
    link: "popular",
  },
  {
    title: "Em Cartaz",
    link: "now_playing",
  },
  {
    title: "Melhores Avaliados",
    link: "top_rated",
  },
  {
    title: "Em Breve",
    link: "upcoming",
  },
]);

const fetchMap = {
  popular: getPopularMovies,
  now_playing: getNowPlayingMovies,
  top_rated: getTopRatedMovies,
  upcoming: getUpcomingMovies,
};

const fetchMovies = async (page = 1) => {
  loading.value = true;
  try {
    const fetchFunction = fetchMap[currentCategory.value];
    const res = await fetchFunction(page);
    movies.value = res.data.results;
    currentPage.value = res.data.page;
    totalPages.value = res.data.total_pages;
  } catch (err) {
    console.error("Erro ao buscar filmes:", err);
  } finally {
    loading.value = false;
  }
};

const changeCategory = (category: MovieCategory) => {
  if (currentCategory.value === category) return;
  currentCategory.value = category;
  currentPage.value = 1;
  fetchMovies();
};

const onPageChange = (page: number) => {
  fetchMovies(page);
};

onMounted(() => {
  fetchMovies();
});
</script>

<template>
  <section>
    <SliderHome />
  </section>

  <section class="container mx-auto py-6 px-4">
    <div class="flex flex-wrap justify-center w-full gap-2 py-6">
      <SecondaryButton
        v-for="{ title, link } in categoryList"
        :key="title"
        @click="changeCategory(link)"
        class="transition-colors duration-300 ease-in"
        :class="{
          'bg-opacity-70 bg-[var(--color-primary)] text-white': currentCategory === link,
        }"
        >{{ title }}
      </SecondaryButton>
    </div>

    <div v-if="loading" class="">
      <div
        class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] sm:grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-6 md:gap-8"
      >
        <SkeletonCard v-for="i in 8" :key="i" />
      </div>
    </div>

    <div v-else-if="movies.length">
      <div
        class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] sm:grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-6 md:gap-8"
      >
        <MovieCard v-for="movie in movies" :key="movie.id" :movie="movie" class="card" />
      </div>
      <div class="p-4">
        <Pagination
          :currentPage="currentPage"
          :totalPages="totalPages"
          @update:page="onPageChange"
        />
      </div>
    </div>
    <div v-else class="text-center place-content-center font-medium text-white min-h-28">
      <p>Nenhum Conteúdo Encontrado...</p>
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
