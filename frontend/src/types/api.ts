import type { Movie } from "@/types/movie";

export interface MovieApiResponse {
    status: string;
    data: {
        page: number,
        results: Movie[]
        total_pages: number
        total_results: number
    };
}
