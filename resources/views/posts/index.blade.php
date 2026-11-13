@extends('layouts.app')

@section('content')
    <form method="GET" action="{{ route('posts.index') }}"
          class="flex flex-col sm:flex-row gap-2 mb-6">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search title"
               class="flex-1 border border-slate-300 bg-white rounded px-3 py-2">

        <select name="category" class="border border-slate-300 bg-white rounded px-3 py-2">
            <option value="">All categories</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>

        <button class="bg-sky-600 hover:bg-sky-700 text-white rounded px-4 py-2">Filter</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($posts as $post)
            <div class="bg-white rounded shadow p-4">
                <div class="flex flex-wrap gap-2 mb-2">
                    @if ($post->is_pinned)
                        <span class="bg-yellow-200 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">Pinned</span>
                    @endif
                    <span class="bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded">{{ $post->category }}</span>
                </div>

                <h2 class="text-lg font-semibold">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $post->published_at->format('M d, Y') }}
                    · {{ $post->views }} views
                    · Author #{{ $post->author_id }}
                </p>
            </div>
        @empty
            <p class="col-span-full">No posts match your search.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

    <p class="text-sm text-slate-500 mt-2">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>
@endsection