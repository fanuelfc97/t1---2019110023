<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $books = Book::query()->latest()->paginate(7);
        $featured = $books->items()[0];
        return view('landing', compact('books', 'featured'));
    }
}
