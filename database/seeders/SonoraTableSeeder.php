<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class SonoraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sonora')->insert([
            [
                'name' => 'Song 1',
                'artist' => 'Artist 1',
                'album' => 'Album 1',
                'genre' => 'Genre 1',
                'year' => 2020,
                'cover_url' => 'https://example.com/cover1.jpg',
                'audio_file' => 'https://example.com/audio1.mp3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Song 2',
                'artist' => 'Artist 2',
                'album' => 'Album 2',
                'genre' => 'Genre 2',
                'year' => 2021,
                'cover_url' => 'https://example.com/cover2.jpg',
                'audio_file' => 'https://example.com/audio2.mp3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more seed data as needed
        ]);
    }
}
