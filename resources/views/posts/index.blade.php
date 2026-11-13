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

        <select name="tag" class="border border-slate-300 bg-white rounded px-3 py-2">
            <option value="">All tags</option>
            @foreach ($tags as $t)
                <option value="{{ $t }}" @selected(request('tag') === $t)>{{ $t }}</option>
            @endforeach
        </select>

        <button class="bg-sky-600 hover:bg-sky-700 text-white rounded px-4 py-2">Filter</button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($posts as $post)
            @include('posts._card')
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