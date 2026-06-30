<?php

namespace App\Http\Controllers;

use App\Models\UserBook;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function index()
    {
        $userBooks = UserBook::with(['user', 'book'])->get();
        return response()->json($userBooks);
    }

    public function show($id)
    {
        $userBook = UserBook::with(['user', 'book'])->findOrFail($id);
        return response()->json($userBook);
    }

    public function update(Request $request, $id)
    {
        $userBook = UserBook::findOrFail($id);
        $userBook->update($request->only(['status', 'current_page', 'rating', 'review', 'start_date', 'finished_date']));
        return response()->json($userBook);
    }

    public function destroy($id)
    {
        $userBook = UserBook::findOrFail($id);
        $userBook->delete();
        return response()->json(['message' => 'User book entry deleted successfully']);
    }
}
