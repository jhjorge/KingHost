import type { Movie } from "@/types/movie";

export interface MovieApiResponse {
    status: string;
    data: Movie[];
}
