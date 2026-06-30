<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::with('books')->get();
    }
    
    public function show($id)
    {
        return User::with('books')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
       $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'password' => 'sometimes|min:8'
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }


    public function getUserBooks($id)
    {
        $user = User::with('books')->findOrFail($id);
        return response()->json($user->books);
    }

    public function addBookToUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        // prevent duplicates
        if ($user->books()->where('book_id', $validated['book_id'])->exists()) {
            return response()->json(['message' => 'Book already added'], 409);
        }

        $user->books()->attach($validated['book_id'], [
            'status' => 'to_read',
            'current_page' => 0,
        ]);

        return response()->json(['message' => 'Book added successfully']);
    }
}


