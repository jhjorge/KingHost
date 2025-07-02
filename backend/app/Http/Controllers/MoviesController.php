<?php

namespace App\Http\Controllers;

use App\Services\MoviesService;
use Illuminate\Http\Request;

class MoviesController extends Controller
{

    public function __construct(private MoviesService $movies_service) {}

    public function index()
    {
        $movies = $this->movies_service->getPopularMovies();

        return response()->json([
            'status' => 'success',
            'data' => $movies ?? [],
        ], 200);
    }

    public function store(Request $request) {}


    public function show(Request $request)
    {

        if ($request->has('query')) {
            $query = $request->query('query');
            $page = $request->query('page', 1);
            $movies = $this->movies_service->searchMovies($query, $page);
        }


        return response()->json([
            'status' => 'success',
            'data' => $movies ?? [],
        ], 200);
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
