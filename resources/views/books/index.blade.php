@extends('layouts.template')

@section('title', 'Books List')

@section('content')
    <div class="mt-4 p-5 bg-black text-white rounded">
        <h1>All Books</h1>
        {{-- Add button --}}
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">Add New Books</a>
    </div>
    </div>
    <div class="container mt-5">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Judul</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Halaman</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($book as $books)
                    <tr>
                        <th scope="row">{{ $books->id }}</th>
                        <td>
                            <a href="{{ route('books.show', $books) }}">
                                {{ $books->judul }}
                            </a>
                        </td>
                        <td>{{ $books->isbn }}</td>
                        <td>{{ $books->halaman }}</td>
                        <td>{{ $books->penerbit }}</td>
                        <td>{{ $books->kategori }}</td>
                        <td>{{ $books->updated_at }}</td>
                        <td>
                            <a href="{{ route('books.edit', $books) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No books found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {!! $book->links() !!}
    </div>

@endsection
