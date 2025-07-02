<?php

namespace App\Http\Controllers;

use App\Services\MoviesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class MoviesController extends Controller
{
    private \DateTimeInterface $ttl;
    public function __construct(private MoviesService $movies_service)
    {
        $this->ttl = now()->addMinutes(30);
    }


    public function getPopular(Request $request)
    {
        $page = $request->query('page', 1);
        $cacheKey = "popular_movies_page_{$page}";
        $movies = Cache::remember($cacheKey, $this->ttl, function () use ($page) {
            return $this->movies_service->getPopularMovies($page);
        });

        return response()->json([
            'status' => 'success',
            'data' => $movies ?? [],
        ], 200);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');
        $page = $request->query('page', 1);


        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Query is required for search.',
            ], 422);
        }

        $movies = $this->movies_service->searchMovies($query, $page);

        return response()->json([
            'status' => 'success',
            'data' => $movies ?? [],
        ], 200);
    }

    public function getNowPlaying(Request $request)
    {
        $page = $request->query('page', 1);
        $cacheKey = "getnowplaying_movies_page_{$page}";
        $movies = Cache::remember($cacheKey, $this->ttl, function () use ($page) {
            return $this->movies_service->getNowPlayingMovies($page);
        });

        return response()->json(['status' => 'success', 'data' => $movies], 200);
    }

    public function getTopRated(Request $request)
    {
        $page = $request->query('page', 1);
        $cacheKey = "gettoprated_movies_page_{$page}";
        $movies = Cache::remember($cacheKey, $this->ttl, function () use ($page) {
            return $this->movies_service->getTopRatedMovies($page);
        });


        return response()->json(['status' => 'success', 'data' => $movies], 200);
    }

    public function getUpcoming(Request $request)
    {
        $page = $request->query('page', 1);
        $cacheKey = "getupcoming_movies_page_{$page}";
        $movies = Cache::remember($cacheKey, $this->ttl, function () use ($page) {
            return $this->movies_service->getUpcomingMovies($page);
        });


        return response()->json(['status' => 'success', 'data' => $movies], 200);
    }
}
