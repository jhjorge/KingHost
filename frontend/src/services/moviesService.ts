import api from "@/services/api";
import type { MovieApiResponse } from "@/types/api";

export const getPopularMovies = async (): Promise<MovieApiResponse> => {
    try {
        const response = await api.get("/movies");
        return response.data;
    } catch (error) {
        console.error("Erro ao buscar filmes populares:", error);
        throw error;
    }
};
