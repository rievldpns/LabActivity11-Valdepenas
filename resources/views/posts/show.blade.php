@extends('layouts.app')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sky-600 hover:underline">← Back to posts</a>

    <article class="bg-white rounded shadow p-6 mt-4">
        <div class="flex flex-wrap gap-2 mb-2">
            @if ($post->is_pinned)
                <span class="bg-yellow-200 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">Pinned</span>
            @endif
            <span class="bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded">{{ $post->category }}</span>
        </div>

        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>

        <p class="text-sm text-slate-500 mt-1">
            {{ $post->published_at->format('F d, Y') }}
            · {{ $post->views }} views
            · Author #{{ $post->author_id }}
        </p>

        <div class="mt-4 leading-relaxed">{{ $post->body }}</div>
    </article>
@endsection