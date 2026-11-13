<div class="bg-white rounded shadow p-4">
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

    <h2 class="text-lg font-semibold">
        <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
    </h2>

    <p class="text-sm text-slate-500 mt-1">
        {{ $post->published_at->format('M d, Y') }}
        · {{ $post->views }} views
        · {{ $post->comments_count }} comments
        · by <a href="{{ route('authors.show', $post->author) }}" class="text-sky-600 hover:underline">{{ $post->author->name }}</a>
    </p>
</div>