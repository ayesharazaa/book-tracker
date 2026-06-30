@extends('layout')

@section('title', 'Explore Books')

@section('content')
<div>
    <h1 class="text-4xl font-bold text-amber-950 mb-2">Explore Books</h1>
    <p class="text-amber-700 mb-8">Discover what to read next.</p>

    <!-- Search & Filter -->
    <div class="mb-8 space-y-4">
        <form method="GET" action="{{ route('home') }}" class="flex gap-4 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or author..." class="flex-1 min-w-64 px-4 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-600">
            
            <select name="genre" class="px-4 py-2 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-600">
                <option value="">All Genres</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded-lg hover:bg-amber-700 transition font-medium">
                Search
            </button>
        </form>
    </div>

    <!-- Books Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($books as $book)
            <div class="bg-white rounded-lg border border-amber-200 overflow-hidden hover:shadow-lg transition">
                <div class="w-full h-40 bg-gradient-to-br from-amber-100 to-amber-200 flex items-center justify-center text-4xl">
                    📚
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-amber-950 line-clamp-2 h-14">{{ $book->title }}</h3>
                    <p class="text-sm text-amber-700 mb-3">{{ $book->author }}</p>
                    <span class="text-xs bg-amber-100 text-amber-900 px-2 py-1 rounded">{{ $book->genre->name }}</span>
                    @auth
                    <div class="mt-4 space-y-2">
                        @if (in_array($book->id, $userBookIds))
                            <button disabled class="w-full bg-gray-300 text-gray-600 py-2 rounded text-sm cursor-not-allowed">
                                Added to Library
                            </button>
                        @else
                            <form method="POST" action="{{ route('library.add') }}" class="inline-block w-full">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="w-full bg-amber-600 text-white py-2 rounded hover:bg-amber-700 transition text-sm font-medium">
                                    Add to Library
                                </button>
                            </form>
                        @endif
                    </div>
                    @endauth

                     @guest
                        <a href="{{ route('login') }}" class="block w-full text-center bg-amber-600 text-white py-2 rounded text-sm font-medium hover:bg-amber-700 transition">
                        Login to save book
                        </a>
                    @endguest
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $books->links() }}
    </div>
</div>
@endsection