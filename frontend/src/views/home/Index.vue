<script setup lang="ts">
import { onMounted, reactive, ref, watch } from "vue";
import MovieCard from "@/components/ui/MovieCard.vue";
import Pagination from "@/components/ui/Pagination.vue";
import SkeletonCard from "@/components/ui/SkeletonCard.vue";
import SkeletonButton from "@/components/ui/buttons/SkeletonButton.vue";
import { useMovieFetcher } from "@/services/fetchMovie";
import type { MovieCategory } from "@/types/movie";
import PrimaryButton from "@/components/ui/buttons/PrimaryButton.vue";
import SearchInput from "@/components/ui/SearchInput.vue";

const {
  movies,
  loading,
  currentPage,
  totalPages,
  currentCategory,
  searchFunction,
  fetchMovies,
  changeCategory,
} = useMovieFetcher();
const query = ref("");
const categoryList: { title: string; link: MovieCategory }[] = reactive([
  { title: "Populares", link: "popular" },
  { title: "Em Cartaz", link: "now_playing" },
  { title: "Melhores Avaliados", link: "top_rated" },
  { title: "Em Breve", link: "upcoming" },
]);

const onPageChange = (page: number) => fetchMovies(page);
const handlerCategory = (link: MovieCategory) => {
  query.value = "";
  changeCategory(link);
};
watch(query, (newValue) => {
  if (newValue.trim() === "") {
    fetchMovies(1);
  }
});
onMounted(() => fetchMovies());
</script>

<template>
  <section class="container mx-auto pt-6">
    <div class="container flex justify-center">
      <SearchInput :loading v-model="query" @search="searchFunction" />
    </div>
  </section>
  <section class="container mx-auto py-6 px-4">
    <div v-if="loading" class="">
      <div class="flex flex-wrap justify-center w-full gap-2 py-6">
        <SkeletonButton v-for="i in 4" :key="i" />
      </div>

      <div
        class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] sm:grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-6 md:gap-8"
      >
        <SkeletonCard v-for="i in 8" :key="i" />
      </div>
    </div>

    <div v-else-if="movies.length">
      <div class="flex flex-wrap justify-center w-full gap-2 py-6">
        <PrimaryButton
          v-for="{ title, link } in categoryList"
          :key="title"
          @click="handlerCategory(link)"
          :disabled="currentCategory === link || loading"
          aria-disabled="true"
          class="transition-colors duration-300 ease-in"
          :class="[
            {
              'bg-[var(--color-secondary)] bg-opacity-70 text-black cursor-not-allowed':
                currentCategory === link,
              'cursor-pointer text-white': currentCategory !== link && !loading,
              'cursor-not-allowed': loading,
            },
          ]"
        >
          {{ title }}
        </PrimaryButton>
      </div>
      <div
        class="grid p-6 grid-cols-[repeat(auto-fit,minmax(200px,1fr))] sm:grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-8 card-container"
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
    <div
      v-else
      class="text-center place-content-center font-medium text-2xl text-white min-h-[68dvh]"
    >
      <p>Nenhum conteúdo encontrado <span class="">😢</span></p>
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
