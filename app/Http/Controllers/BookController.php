<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Genre;
use App\Models\Book; 
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('genre')->get();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::with('genre')->findOrFail($id);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->only(['title', 'author', 'published_year', 'genre_id']));
        return response()->json($book);
    }

    public function browse(Request $request)
    {
        $query = Book::with('genre');
 
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }
 
        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }
 
        $books = $query->paginate(12)->withQueryString();
        $genres = Genre::all();
        $userBookIds = [];
        if (Auth::check()) {
            $userBookIds = Auth::user()
                ->books()
                ->pluck('book_id')
                ->toArray();
        }
        return view('browse', compact('books', 'genres', 'userBookIds'));
    }
 
}
