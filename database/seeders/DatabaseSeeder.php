<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Like as Like;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Question::factory(10)->create();
        \App\Models\Reply::factory(50)->create()->each(function ($reply) {
            return $reply->likes()->save(Like::factory()->make());
        });
    }
}
