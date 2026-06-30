@extends('layout')

@section('title', 'My Library')

@section('content')
<div>
    <h1 class="text-4xl font-bold text-amber-950 mb-2">My Library</h1>
    <p class="text-amber-700 mb-8">Organize and track your books.</p>

    <!-- To Read -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-amber-950 mb-6">To Read ({{ $toRead->count() }})</h2>
        @if ($toRead->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($toRead as $book)
                    <div class="bg-white rounded-lg border border-amber-200 p-6 hover:shadow-lg transition">
                        <div class="w-full h-32 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg mb-4 flex items-center justify-center text-3xl">
                            📚
                        </div>
                        <h3 class="font-bold text-amber-950 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-sm text-amber-700 mb-3">{{ $book->author }}</p>
                        <span class="text-xs bg-amber-100 text-amber-900 px-3 py-1 rounded-full">{{ $book->genre->name }}</span>
                        <a href="{{ route('show', $book->id) }}" class="block mt-4 text-center bg-amber-600 text-white py-2 rounded hover:bg-amber-700 transition text-sm">
                            Start Reading
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-amber-700 italic">No books yet. Add one to get started!</p>
        @endif
    </div>

    <!-- Currently Reading -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-amber-950 mb-6">Currently Reading ({{ $currentlyReading->count() }})</h2>
        @if ($currentlyReading->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($currentlyReading as $book)
                    <div class="bg-white rounded-lg border border-amber-200 p-6 hover:shadow-lg transition">
                        <div class="w-full h-32 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg mb-4 flex items-center justify-center text-3xl">
                            📖
                        </div>
                        <h3 class="font-bold text-amber-950 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-sm text-amber-700 mb-3">{{ $book->author }}</p>
                        
                        @php
                            $percentage = ($book->pivot->current_page / $book->pages) * 100;
                        @endphp
                        
                        <div class="mb-4">
                            <div class="text-xs text-amber-700 mb-1">{{ $book->pivot->current_page }} / {{ $book->pages }} pages</div>
                            <div class="w-full bg-amber-100 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        
                        <a href="{{ route('show', $book->id) }}" class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition text-sm">
                            Update Progress
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-amber-700 italic">Start a book to see it here.</p>
        @endif
    </div>

    <!-- Finished -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-amber-950 mb-6">Finished ({{ $finished->count() }})</h2>
        @if ($finished->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($finished as $book)
                    <div class="bg-white rounded-lg border border-amber-200 p-6 hover:shadow-lg transition">
                        <div class="w-full h-32 bg-gradient-to-br from-green-100 to-green-200 rounded-lg mb-4 flex items-center justify-center text-3xl">
                            ✓
                        </div>
                        <h3 class="font-bold text-amber-950 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-sm text-amber-700 mb-3">{{ $book->author }}</p>
                        
                        @if ($book->pivot->rating)
                            <div class="mb-3">
                                <span class="text-lg">★</span>
                                <span class="font-semibold text-amber-900">{{ $book->pivot->rating }}/5</span>
                            </div>
                        @endif
                        
                        <a href="{{ route('show', $book->id) }}" class="block text-center bg-green-600 text-white py-2 rounded hover:bg-green-700 transition text-sm">
                            View Review
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-amber-700 italic">Finish a book to see it here.</p>
        @endif
    </div>
</div>
@endsection