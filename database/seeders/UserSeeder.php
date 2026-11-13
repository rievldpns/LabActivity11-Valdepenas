<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Lola Valdepenas',
            'email' => 'lola.valdepenas@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawadUser = User::create([
            'name' => 'Kagawad Sarah Valdepenas',
            'email' => 'kagawad.valdepenas@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        Author::where('email', 'kagawad.valdepenas@bulletin.test')
            ->update(['user_id' => $kagawadUser->id]);

        User::factory()->count(8)->create();
    }
}