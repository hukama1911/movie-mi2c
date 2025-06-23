@extends('layouts.template')

@section('content')
    <h1 class="text-success">Film Terbaru</h1>

    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ Str::startsWith($movie->cover_image, ['http://', 'https://']) ? $movie->cover_image : asset('storage/' . $movie->cover_image) }}"
                                class="img-fluid rounded-start" alt="{{ $movie->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="card-text">{{ Str::words($movie->synopsis, 20) }}</p>
                                <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-success">Lihat Detail</a>
                                @auth
                                    <div class="d-flex align-items-center mt-2">
                                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-primary">Edit</a>
                                        @can('delete')
                                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="ms-2"
                                                onsubmit="return confirm('Yakin ingin menghapus movie ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @endcan
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $movies->links() }}
    </div>
@endsection
