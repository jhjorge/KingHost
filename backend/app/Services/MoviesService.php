<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoviesService
{
    protected $baseUrl = 'https://api.themoviedb.org/3';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
    }

    protected function request(string $endpoint, array $params = [])
    {
        $params['api_key'] = $this->apiKey;
        $params['language'] = 'pt-BR';

        return Http::get("{$this->baseUrl}{$endpoint}", $params)->json();
    }

    public function getAllPopularMovies(int $maxPages = 3)
    {
        $allMovies = [];

        for ($page = 1; $page <= $maxPages; $page++) {
            $result = $this->request('/movie/popular', ['page' => $page]);

            if (isset($result['results'])) {
                $allMovies = array_merge($allMovies, $result['results']);
            }
        }

        return $allMovies;
    }

    public function searchMovies(string $query, int $page = 1)
    {
        return $this->request('/search/movie', [
            'query' => $query,
            'page' => $page,
        ]);
    }
}
