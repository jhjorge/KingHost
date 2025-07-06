<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MoviesService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
        $this->baseUrl = env('TMDB_BASE_URL');
    }

    protected function request(string $endpoint, array $params = [])
    {
        $params['api_key'] = $this->apiKey;
        $params['language'] = 'pt-BR';

        return Http::get("{$this->baseUrl}{$endpoint}", $params)->json();
    }

    public function searchMovies(string $query, int $page = 1)
    {
        return $this->request('/search/movie', [
            'query' => $query,
            'page' => $page,
        ]);
    }

    public function getGenre()
    {
        $result = $this->request('/genre/movie/list');

        if (!isset($result['genres'])) {
            return [];
        }

        return $result['genres'];
    }

    public function getPopularMovies(int $page = 1)
    {
        $result = $this->request('/movie/popular', ['page' => $page]);
        if (!isset($result['results'])) {
            return [];
        }
        $movies = collect($result['results'])
            ->filter(fn($movie) => !empty($movie['release_date']))
            ->sortByDesc('release_date')
            ->values();
        $result['results'] = $movies->all();
        return $result;
    }

    public function getNowPlayingMovies(int $page = 1)
    {
        $result =  $this->request('/movie/now_playing', ['page' => $page]);
        if (!isset($result['results'])) {
            return [];
        }
        $movies = collect($result['results'])
            ->filter(fn($movie) => !empty($movie['release_date']))
            ->sortByDesc('release_date')
            ->values();
        $result['results'] = $movies->all();
        return $result;
    }

    public function getTopRatedMovies(int $page = 1)
    {
        $result = $this->request('/movie/top_rated', ['page' => $page]);
        if (!isset($result['results'])) {
            return [];
        }
        $movies = collect($result['results'])
            ->filter(fn($movie) => !empty($movie['release_date']))
            ->sortByDesc('release_date')
            ->values();
        $result['results'] = $movies->all();
        return $result;
    }

    public function getUpcomingMovies(int $page = 1)
    {
        $result = $this->request('/movie/upcoming', ['page' => $page]);
        if (!isset($result['results'])) {
            return [];
        }
        $movies = collect($result['results'])
            ->filter(fn($movie) => !empty($movie['release_date']))
            ->sortByDesc('release_date')
            ->values();
        $result['results'] = $movies->all();
        return $result;
    }
}
