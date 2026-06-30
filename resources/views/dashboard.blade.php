@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-4xl font-bold text-amber-950 mb-2">Welcome back, {{ Auth::user()->name }}</h1>
        <p class="text-amber-700">Here's what you're reading.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg p-6 border border-amber-200">
            <p class="text-sm text-amber-700 font-medium">To Read</p>
            <p class="text-3xl font-bold text-amber-950 mt-2">{{ $stats['toRead'] }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 border border-amber-200">
            <p class="text-sm text-amber-700 font-medium">Currently Reading</p>
            <p class="text-3xl font-bold text-amber-950 mt-2">{{ $stats['currentlyReading'] }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 border border-amber-200">
            <p class="text-sm text-amber-700 font-medium">Finished</p>
            <p class="text-3xl font-bold text-amber-950 mt-2">{{ $stats['finished'] }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 border border-amber-200">
            <p class="text-sm text-amber-700 font-medium">Pages Read</p>
            <p class="text-3xl font-bold text-amber-950 mt-2">{{ $stats['totalPagesRead'] }}</p>
        </div>
    </div>

    <!-- Currently Reading -->
    @if ($currentBook)
        <div class="bg-white rounded-lg p-8 border border-amber-200">
            <h2 class="text-2xl font-bold text-amber-950 mb-6">Currently Reading</h2>
            <div class="flex gap-8">
                <div class="w-32 h-48 bg-gradient-to-br from-amber-200 to-amber-300 rounded-lg flex items-center justify-center text-4xl">
                    📖
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-amber-950">{{ $currentBook->title }}</h3>
                    <p class="text-amber-700 mb-4">by {{ $currentBook->author }}</p>
                    
                    @php
                        $percentage = ($currentBook->pivot->current_page / $currentBook->pages) * 100;
                    @endphp
                    
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-amber-700 mb-2">
                            <span>{{ $currentBook->pivot->current_page }} / {{ $currentBook->pages }} pages</span>
                            <span>{{ round($percentage) }}%</span>
                        </div>
                        <div class="w-full bg-amber-100 rounded-full h-2">
                            <div class="bg-amber-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                    
                    <a href="{{ route('show', $currentBook->id) }}" class="inline-block bg-amber-600 text-white px-6 py-2 rounded-lg hover:bg-amber-700 transition">
                        Update Progress
                    </a>
                </div>
            </div>
        </div>
    @endif

    <div class="text-center">
        <a href="{{ route('home') }}" class="inline-block bg-amber-600 text-white px-8 py-3 rounded-lg hover:bg-amber-700 transition font-medium">
            Discover More Books
        </a>
    </div>
</div>
@endsection