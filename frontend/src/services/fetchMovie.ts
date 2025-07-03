import { ref } from "vue";
import {
    getPopularMovies,
    getNowPlayingMovies,
    getTopRatedMovies,
    getUpcomingMovies,
} from "@/services/moviesService";
import type { Movie, MovieCategory } from "@/types/movie";



const fetchMap = {
    popular: getPopularMovies,
    now_playing: getNowPlayingMovies,
    top_rated: getTopRatedMovies,
    upcoming: getUpcomingMovies,
};

export function useMovieFetcher() {
    const movies = ref<Movie[]>([]);
    const loading = ref(false);
    const currentPage = ref(1);
    const totalPages = ref(1);
    const currentCategory = ref<MovieCategory>("popular");

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

    return {
        movies,
        loading,
        currentPage,
        totalPages,
        currentCategory,
        fetchMovies,
        changeCategory,
    };
}
