@extends('layout')

@section('title', 'Welcome')

@section('content')
<div class="text-center py-20">
    <h1 class="text-4xl font-bold">📚 Welcome to BookLib</h1>
    <p class="mt-4 text-amber-700">Track your reading journey easily.</p>

    <a href="{{ route('browse') }}"
       class="mt-6 inline-block bg-amber-600 text-white px-6 py-3 rounded-lg">
        Start Exploring
    </a>
</div>
@endsection