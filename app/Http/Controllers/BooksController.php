<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $books = Books::all();
        $book = Book::paginate(10);
        return view('books.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'isbn' => 'required|string|size:13',
            'judul' => 'required|string|max:255',
            'halaman' => 'required|integer',
            'kategori' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'image' => 'required|string|max:255',
        ]);

         // Simpan gambar jika ada
         if ($request->hasFile('image')) {
            // Validasi gambar
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // Upload gambar dan dapatkan path gambar yang diupload
            $imagePath = $request->file('image')->store('public/images');

            $validated['image'] = $imagePath;
        }

        // Buat book baru
        $books = Book::create([
            'judul' => $validated['judul'],
            'isbn' => $validated['isbn'],
            'halaman' => $validated['halaman'],
            'kategori' => $validated['kategori'],
            'penerbit' => $validated['penerbit'],
            'image' => $validated['image'] ?? null,
        ]);


        return redirect()->route('books.index')->with('success', 'Book Created');
    }
    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
                'isbn' => 'required|string|size:13',
                'judul' => 'required|string|max:255',
                'halaman' => 'required|integer',
                'kategori' => 'required|string|max:255',
                'penerbit' => 'required|string|max:255',
                'image' => 'required|string|max:255',
            ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            // Validasi gambar
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            // Upload gambar dan dapatkan path gambar yang diupload
            $imagePath = $request->file('image')->store('public/images');

            // Hapus gambar lama jika ada
            if ($book->image) {
                Storage::delete($book->image);
            }

            $validated['image'] = $imagePath;
        }

        // Update artikel
        $book->update([
            'judul' => $validated['judul'],
            'isbn' => $validated['isbn'],
            'halaman' => $validated['halaman'],
            'kategori' => $validated['kategori'],
            'penerbit' => $validated['penerbit'],
            'image' => $validated['image'] ?? $book->image,
        ]);
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
