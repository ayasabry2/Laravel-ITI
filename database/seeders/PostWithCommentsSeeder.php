<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostWithCommentsSeeder extends Seeder
{
    public function run(): void
    {
        $authors = ['Aya', 'Ahmed', 'Omar'];
        $commentsSamples = [
            "Great post!",
            "Thanks for sharing.",
            "Very informative.",
            "I enjoyed reading this.",
            "Can you explain more?",
            "This was confusing at first."
        ];

        for ($i = 1; $i <= 50; $i++) {
            $postId = DB::table('posts')->insertGetId([
                'title' => "Fake Post $i",
                'created_by' => $authors[array_rand($authors)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $numComments = rand(2, 4);
            for ($j = 0; $j < $numComments; $j++) {
                DB::table('comments')->insert([
                    'post_id' => $postId,
                    'content' => $commentsSamples[array_rand($commentsSamples)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
