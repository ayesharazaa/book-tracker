<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $books = $user->books()->with('genre')->get();
        
        $toRead = $books->where('pivot.status', 'to_read');
        $currentlyReading = $books->where('pivot.status', 'currently_reading');
        $finished = $books->where('pivot.status', 'finished');
        
        $currentBook = $currentlyReading->first();
        
         $stats = [
            'toRead' => $toRead->count(),
            'currentlyReading' => $currentlyReading->count(),
            'finished' => $finished->count(),

            'totalPagesRead' => $finished->sum(function ($book) {
                return $book->pages;
            }) + $currentlyReading->sum('pivot.current_page'),

            'averageRating' => $finished->isNotEmpty()
                ? round($finished->avg('pivot.rating'), 1)
                : 0,
        ];
        
        return view('dashboard', [
            'stats' => $stats,
            'currentBook' => $currentBook,
        ]);
    }
}