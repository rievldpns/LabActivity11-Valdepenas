<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Purok Valdepenas', 'Urgent', 'Libre', 'Schedule', 'Event'];

        foreach ($names as $name) {
            Tag::create(['name' => $name]);
        }

        $allTags = Tag::all();

        foreach (Post::all() as $post) {
            $post->tags()->attach(
                $allTags->random(rand(1, 3))->pluck('id')
            );
        }

        $pinned = Post::where('is_pinned', true)->first();
        $pinned->tags()->sync(
            Tag::whereIn('name', ['Purok Valdepenas', 'Urgent'])->pluck('id')
        );
    }
}