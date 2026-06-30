@extends('layout')

@section('title', $userBook->title)

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Left Column --}}
    <div>

        <div class="w-full bg-gradient-to-br from-amber-200 to-amber-300 rounded-lg aspect-[3/4] flex items-center justify-center text-6xl mb-6">
            📖
        </div>

        <div class="bg-white rounded-lg p-6 border border-amber-200">
            <h3 class="font-bold text-amber-900 mb-2">About</h3>

            <p class="text-sm text-amber-700 mb-4">
                {{ $userBook->description }}
            </p>

            <div class="space-y-2 text-sm">

                <div>
                    <span class="text-amber-700">Author:</span>
                    <span class="font-semibold text-amber-950">
                        {{ $userBook->author }}
                    </span>
                </div>

                <div>
                    <span class="text-amber-700">Pages:</span>
                    <span class="font-semibold text-amber-950">
                        {{ $userBook->pages }}
                    </span>
                </div>

                <div>
                    <span class="text-amber-700">Genre:</span>
                    <span class="font-semibold text-amber-950">
                        {{ $userBook->genre->name }}
                    </span>
                </div>

                <div>
                    <span class="text-amber-700">Published:</span>
                    <span class="font-semibold text-amber-950">
                        {{ $userBook->published_year }}
                    </span>
                </div>

            </div>
        </div>

    </div>

    {{-- Right Column --}}
    <div class="lg:col-span-2 space-y-6">

        <div>

            <a href="{{ route('library') }}"
               class="text-amber-600 hover:text-amber-700 text-sm inline-block mb-4">
                ← Back to Library
            </a>

            <h1 class="text-3xl font-bold text-amber-950">
                {{ $userBook->title }}
            </h1>

            <p class="text-amber-700 mt-1">
                by {{ $userBook->author }}
            </p>

        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Reading Progress --}}
        <div class="bg-white rounded-lg p-6 border border-amber-200">

            <h2 class="text-xl font-bold text-amber-950 mb-4">
                Reading Progress
            </h2>

            @php
                $progress = $userBook->pages > 0
                    ? round(($userBook->pivot->current_page / $userBook->pages) * 100)
                    : 0;
            @endphp

            <div class="mb-6">

                <div class="flex justify-between text-sm text-amber-700 mb-2">

                    <span>Progress</span>

                    <span>{{ $progress }}%</span>

                </div>

                <div class="w-full bg-amber-100 rounded-full h-3">

                    <div
                        class="bg-amber-600 h-3 rounded-full"
                        style="width: {{ $progress }}%;">
                    </div>

                </div>

                <p class="text-xs text-amber-700 mt-2">

                    {{ $userBook->pivot->current_page }}

                    /

                    {{ $userBook->pages }} pages

                </p>

            </div>

            <form
                method="POST"
                action="{{ route('book.progress', $userBook->id) }}"
                class="space-y-4">

                @csrf

                <div>

                    <label class="block font-medium mb-2">
                        Current Page
                    </label>

                    <input
                        type="number"
                        name="current_page"
                        value="{{ $userBook->pivot->current_page }}"
                        min="0"
                        max="{{ $userBook->pages }}"
                        required
                        class="w-full border border-amber-200 rounded-lg px-4 py-2">

                </div>

                <button
                    class="w-full bg-amber-600 text-white py-2 rounded-lg hover:bg-amber-700">

                    Update Progress

                </button>

            </form>

            @if($userBook->pivot->status == 'finished')

                <div class="mt-5 p-3 rounded bg-green-100 text-green-700">

                    ✓ Finished on

                    {{ \Carbon\Carbon::parse($userBook->pivot->finished_date)->format('M d, Y') }}

                </div>

            @elseif($userBook->pivot->status == 'currently_reading')

                <div class="mt-5 text-amber-700">

                    Started on

                    {{ \Carbon\Carbon::parse($userBook->pivot->start_date)->format('M d, Y') }}

                </div>

            @endif

        </div>

        {{-- Review Form --}}
        @if($userBook->pivot->status == 'finished')

        <div class="bg-white rounded-lg p-6 border border-amber-200">

            <h2 class="text-xl font-bold text-amber-950 mb-4">
                Your Review
            </h2>

            <form method="POST" action="{{ route('book.review', $userBook->id) }}">

                @csrf

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Rating
                    </label>

                    <select
                        name="rating"
                        class="w-full border border-amber-200 rounded-lg px-4 py-2">

                        <option value="">Choose Rating</option>

                        @for($i=1;$i<=5;$i++)

                            <option
                                value="{{ $i }}"
                                {{ ($myReview?->rating == $i) ? 'selected' : '' }}>

                                {{ $i }} Star{{ $i>1 ? 's' : '' }}

                            </option>

                        @endfor

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block mb-2 font-medium">
                        Review
                    </label>

                    <textarea
                        name="review"
                        rows="5"
                        class="w-full border border-amber-200 rounded-lg px-4 py-2">{{ $myReview?->review }}</textarea>

                </div>

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                    Save Review

                </button>

            </form>

        </div>

        @endif

        {{-- All Reviews --}}
        <div class="bg-white rounded-lg p-6 border border-amber-200">

            <h2 class="text-2xl font-bold mb-5">
                Ratings & Reviews
            </h2>

            @forelse($userBook->reviews as $review)

                <div class="border-b border-gray-200 py-4">

                    <div class="flex justify-between items-center">

                        <h3 class="font-semibold text-lg">

                            {{ $review->user->name }}

                        </h3>

                        <span class="text-yellow-600">

                            {{ $review->rating }}/5 ⭐

                        </span>

                    </div>

                    @if($review->review)

                        <p class="mt-2 text-gray-700">

                            {{ $review->review }}

                        </p>

                    @endif

                    <p class="text-xs text-gray-500 mt-2">

                        {{ $review->created_at->format('M d, Y') }}

                    </p>

                </div>

            @empty

                <p class="text-gray-600">
                    No reviews yet.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection