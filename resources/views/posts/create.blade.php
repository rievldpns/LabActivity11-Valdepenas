@extends('layouts.app')

@section('title', 'New post')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sky-600 hover:underline">← Back to posts</a>

    <h1 class="text-2xl font-bold mt-4 mb-4">New post</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-300 text-red-800 text-sm rounded px-4 py-3">
            <p class="font-semibold mb-1">Please fix the following:</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.store') }}" class="bg-white rounded shadow p-6 space-y-4 max-w-2xl">
        @csrf

        <div>
            <label for="title" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                   class="w-full border border-slate-300 rounded p-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">
            @error('title') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="body" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Body</label>
            <textarea id="body" name="body" rows="5"
                      class="w-full border border-slate-300 rounded p-2 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400">{{ old('body') }}</textarea>
            @error('body') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="category" class="block text-xs font-semibold text-slate-600 uppercase mb-1">Category</label>
            <select id="category" name="category" class="w-full border border-slate-300 rounded p-2 text-sm bg-white">
                <option value="">Choose a category</option>
                @foreach ($categories as $c)
                    <option value="{{ $c }}" @selected(old('category') === $c)>{{ $c }}</option>
                @endforeach
            </select>
            @error('category') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <p class="block text-xs font-semibold text-slate-600 uppercase mb-1">Tags</p>
            <div class="flex flex-wrap gap-4">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                               @checked(in_array($tag->id, old('tags', [])))>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>
            @error('tags') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            @error('tags.*') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))>
                Publish now
            </label>
            <p class="text-xs text-slate-500 mt-1">Leave unchecked to save as a draft. Drafts won't show on the bulletin.</p>
            @error('is_published') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white text-sm rounded px-4 py-2">Save post</button>
    </form>
@endsection