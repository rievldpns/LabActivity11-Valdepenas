@extends('layouts.app')

@section('title', $author->name)

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sky-600 hover:underline">← Back to posts</a>

    <div class="bg-white rounded shadow p-6 mt-4 mb-6">
        <h1 class="text-2xl font-bold">{{ $author->name }}</h1>
        <p class="text-slate-500">{{ $author->position }}</p>
        <p class="mt-2 text-sm font-semibold text-sky-700">{{ $commentsReceived }} comments received</p>
    </div>

    <h2 class="text-lg font-semibold mb-3">Published posts</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($posts as $post)
            @include('posts._card')
        @empty
            <p class="col-span-full text-slate-500">No published posts yet.</p>
        @endforelse
    </div>
@endsection