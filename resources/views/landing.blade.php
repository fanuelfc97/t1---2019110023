@extends('layouts.template')

@section('title', 'Landing Page')

@section('content')
    {{-- Cek jika $featured tidak kosong --}}
    @if ($featured)
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
            <div class="row mb-2">
                <div class="col-md-6 px-0">
                    <h1 class="display-4 fst-italic">{{ $featured->judul }}</h1>
                    <p class="lead my-3">{{ Str::limit($featured->isbn, 50, ' ...') }}</p>
                    <p class="lead mb-0">
                        <a href="{{ route('books.show', $featured) }}" class="text-white fw-bold">
                            Continue reading...
                        </a>
                    </p>
                </div>
                <div class="col-md-6">
                    @if ($featured->image)
                        <img src="{{ $featured->image_url }}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/250x200" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    @endif
    {{-- Articles Card --}}
    <div class="row mb-2">
        @forelse ($books as $book)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">World</strong>
                        <h3 class="mb-0">{{ $book->judul }}</h3>
                        <div class="mb-1 text-muted">{{ $book->updated_at }}</div>
                        <p class="card-text mb-auto">{{ Str::limit($book->halaman, 50, ' ...') }}</p>
                        <a href="{{ route('books.show', $book) }}" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        @if ($book->image)
                            <img src="{{ $book->image_url }}" alt="image" width="200" height="250">
                        @else
                            <img src="https://via.placeholder.com/200x250" width="200" height="250">
                        @endif
                    </div>
                </div>
            </div>

        @empty
            <div class="col-md-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h2 class="card-text mb-auto">No books found.</h2>
                    </div>
                </div>
            </div>
        @endforelse

        {{ $books->links() }}
    </div>
@endsection
