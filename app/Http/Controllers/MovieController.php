<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function homepage()
    {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }
    // Method baru untuk menampilkan detail movie
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('create_movie', compact('categories'));
    }
    public function store()
    {
        $categories = Category::all();
        return view('create_movie', compact('categories'));
    }
}
