<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\Kuliner;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua data post
        $posts = Post::all();
        foreach ($posts as $post) {
            Image::create([
                'post_id' => $post->id,
                'image_path' => $post->image,
            ]);
        }

        // Ambil semua data kuliner
        $kuliners = Kuliner::all();
        foreach ($kuliners as $kuliner) {
            Image::create([
                'kuliner_id' => $kuliner->id,
                'image_path' => $kuliner->image,
            ]);
        }
    }
}
