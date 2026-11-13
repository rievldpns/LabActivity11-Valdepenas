<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $publishedPosts = Post::where('is_published', true)->get();

        foreach ($publishedPosts as $post) {
            $howMany = rand(0, 5);

            for ($i = 0; $i < $howMany; $i++) {
                Comment::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                ]);
            }
        }

        $pinned = Post::where('is_pinned', true)->first();
        $lola = User::where('email', 'lola.valdepenas@bulletin.test')->first();

        Comment::create([
            'post_id' => $pinned->id,
            'user_id' => $lola->id,
            'body' => 'Salamat Kagawad! Pupunta kami sa clean-up drive.',
        ]);

        Comment::create([
            'post_id' => $pinned->id,
            'user_id' => $users->random()->id,
            'body' => 'Anong oras ang clean-up?',
        ]);

        Comment::create([
            'post_id' => $pinned->id,
            'user_id' => $users->random()->id,
            'body' => 'Libre ba ang sacks o kami ang magdadala nito?',
        ]);
    }
}