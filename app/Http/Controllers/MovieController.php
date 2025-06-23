<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1901|max:' . date('Y'),
            'actors' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload cover image
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        // Tambahkan slug
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        // Simpan data movie
        Movie::create($validated);

        // Redirect ke homepage dengan pesan sukses
        return redirect()->route('homepage')->with('success', 'Movie berhasil ditambahkan!');
    }


    // ...existing code...

    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('editmovie', compact('movie', 'categories'));
    }

    // ...existing code...

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1901|max:' . date('Y'),
            'actors' => 'nullable|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload cover image jika ada file baru
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');

            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        // Update slug jika judul berubah
        if ($movie->title !== $validated['title']) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . uniqid();
        }

        $movie->update($validated);

        return redirect()->route('homepage')->with('success', 'Movie berhasil diupdate!');
    }

    // ..

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('homepage')->with('success', 'Movie berhasil dihapus!');
    }
}
