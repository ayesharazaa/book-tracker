<?php


namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $books = $user->books()->with('genre')->get();
        
        $toRead = $books->where('pivot.status', 'to_read');
        $currentlyReading = $books->where('pivot.status', 'currently_reading');
        $finished = $books->where('pivot.status', 'finished');
        $dropped = $books->where('pivot.status', 'dropped');
        
        return view('library_index', [
            'toRead' => $toRead,
            'currentlyReading' => $currentlyReading,
            'finished' => $finished,
            'dropped' => $dropped
        ]);
    }
    
    public function addBook(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
        ]);
        $book = Book::findOrFail($validated['book_id']);
        if ($user->books()->where('book_id', $book->id)->exists()) {

            //If yes don't add it again
            return back()->with(
                'error',
                'This book is already in your library.'
            );
        }
        if (!$user->books()->where('book_id', $book->id)->exists()) {
            $user->books()->attach($book->id, [
                'status' => 'to_read',
                'current_page' => 0,
            ]);
             return back()->with(
            'success',
            'Book added to your library!'
        );
        }
        
        return back()->with('success', 'Book added to your library!');
    }

    public function removeBook(Book $book): RedirectResponse
    {

        $user = Auth::user();
        if($user->books()->where('book_id', $book->id)->exists()) {
        $user->books()->detach($book->id);

        return back()->with(
            'success',
            'Book removed from your library.'
        );}
        return back()->with(
            'error',
            'This book is not in your library.'
        );
    }
       
}