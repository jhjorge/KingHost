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

    public function getPopularMovies(int $page = 1)
    {
        $result = $this->request('/movie/popular', ['page' => $page]);

        return $result['results'];
    }

    public function searchMovies(string $query, int $page = 1)
    {
        return $this->request('/search/movie', [
            'query' => $query,
            'page' => $page,
        ]);
    }
}
