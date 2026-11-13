@extends('layouts.app')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sky-600 hover:underline">← Back to posts</a>

    <article class="bg-white rounded shadow p-6 mt-4">
        <div class="flex flex-wrap gap-2 mb-2">
            @if ($post->is_pinned)
                <span class="bg-yellow-200 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">Pinned</span>
            @endif
            <span class="bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded">{{ $post->category }}</span>

            @foreach ($post->tags as $tag)
                <a href="{{ route('posts.index', ['tag' => $tag->name]) }}"
                   class="bg-emerald-100 text-emerald-800 text-xs px-2 py-1 rounded hover:bg-emerald-200">{{ $tag->name }}</a>
            @endforeach
        </div>

        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>

        <p class="text-sm text-slate-500 mt-1">
            {{ $post->published_at->format('F d, Y') }}
            · {{ $post->views }} views
            · by <a href="{{ route('authors.show', $post->author) }}" class="text-sky-600 hover:underline">{{ $post->author->name }}</a>
        </p>

        <div class="mt-4 leading-relaxed">{{ $post->body }}</div>
    </article>

    <section class="mt-6">
        <h2 class="text-lg font-semibold mb-3">Comments ({{ $post->comments->count() }})</h2>

        <div class="space-y-3">
            @forelse ($post->comments as $comment)
                <div class="bg-white rounded shadow p-3">
                    <p class="text-sm font-semibold">
                        {{ $comment->user->name }}
                        <span class="text-slate-400 font-normal">· {{ $comment->created_at->diffForHumans() }}</span>
                    </p>
                    <p class="mt-1">{{ $comment->body }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-500">No comments yet.</p>
            @endforelse
        </div>
    </section>
@endsection