<?php

namespace App\Http\Controllers;

use App\Models\Genre; 
use Illuminate\Http\Request;

class GenreController extends Controller
{
    
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    public function show($id)
    {
        $genre = Genre::with('books')->findOrFail($id);
        return response()->json($genre);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($request->only(['name', 'description']));
        return response()->json($genre);
    }


}
