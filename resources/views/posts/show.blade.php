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

        @auth
            @if ($errors->any())
                <div class="mb-3 bg-red-100 border border-red-300 text-red-800 text-sm rounded px-4 py-3">
                    <p class="font-semibold mb-1">Please fix the following:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('comments.store', $post) }}" class="bg-white rounded shadow p-4 mb-4">
                @csrf
                <label for="body" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Add a comment</label>
                <textarea id="body" name="body" rows="3"
                          class="w-full border border-slate-300 rounded p-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror

                <button type="submit" class="mt-2 bg-sky-600 hover:bg-sky-700 text-white text-sm rounded px-4 py-2">Post comment</button>
            </form>
        @endauth

        @guest
            <p class="bg-white rounded shadow p-4 mb-4 text-sm">
                <a href="{{ route('login') }}" class="text-sky-600 hover:underline">Sign in to comment</a>
            </p>
        @endguest

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