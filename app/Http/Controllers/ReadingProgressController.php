<?php

namespace App\Http\Controllers;

use App\Models\UserBook;
use App\Models\Review; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReadingProgressController extends Controller
{
    
public function show($id)
{
    $user = Auth::user();

    $book = $user->books()
        ->with(['genre', 'reviews.user'])
        ->where('book_id', $id)
        ->firstOrFail();

    $myReview = Review::where('user_id', $user->id)
        ->where('book_id', $id)
        ->first();

    return view('show', [
        'userBook' => $book,
        'myReview' => $myReview,
    ]);
}

    public function updateProgress(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'current_page' => 'required|integer|min:0'
        ]);

        $book = $user->books()->where('book_id', $id)->firstOrFail();

        $totalPages = $book->pages;
        $currentPage = $request->current_page;

        // update pivot
        $user->books()->updateExistingPivot($id, [
            'current_page' => $currentPage,
        ]);

        // auto status update
        if ($currentPage >= $totalPages) {
            $user->books()->updateExistingPivot($id, [
                'status' => 'finished',
                'finished_date' => now(),
            ]);
        } elseif ($book->pivot->status === 'to_read') {
            $user->books()->updateExistingPivot($id, [
                'status' => 'currently_reading',
                'start_date' => now(),
            ]);
        }

        return back()->with('success', 'Reading progress updated!');
    }

    public function updateReview(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        Review::updateOrCreate(
        [
        'user_id' => $user->id,
        'book_id' => $id,
        ],
        [
        'rating' => $request->rating,
        'review' => $request->review,
        ]);

        return redirect()->route('show', $id)
    ->with('success', 'Review saved!');
    }
}