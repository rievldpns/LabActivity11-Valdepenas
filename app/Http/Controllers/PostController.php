<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // kasi 10 letters ang valdepenas
    private const PER_PAGE = 10;

    public function index(Request $request)
    {
        $posts = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->when($request->filled('tag'), function ($query) use ($request) {
                $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('name', $request->tag);
                });
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        $categories = Post::query()->distinct()->orderBy('category')->pluck('category');
        $tags = Tag::orderBy('name')->pluck('name');

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function create(Request $request)
    {
        // residents have no author profile, so no new posts for them
        abort_unless($request->user()->author, 403);

        return view('posts.create', [
            'tags' => Tag::orderBy('name')->get(),
            'categories' => Post::CATEGORIES,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $tagIds = $data['tags'];
        unset($data['tags']);

        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        $post = $request->user()->author->posts()->create($data);
        $post->tags()->sync($tagIds);

        if ($post->is_published) {
            return redirect()->route('posts.show', $post)->with('status', 'Post published.');
        }

        return redirect()->route('posts.index')->with('status', 'Draft saved.');
    }

    public function show($id)
    {
        $post = Post::where('is_published', true)->findOrFail($id);

        $post->views = $post->views + 1;
        $post->save();

        $post->load([
            'author',
            'tags',
            'comments' => fn ($q) => $q->latest()->latest('id'),
            'comments.user',
        ]);

        return view('posts.show', compact('post'));
    }
}