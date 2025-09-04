<?php

namespace Database\Seeders;

use App\Models\FaviconAndTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaviconAndTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FaviconAndTitle::firstOrCreate(
            [],
            [
                'favicon' => 'default-favicon.ico',
                'title' => 'E-Commerce',
            ]
        );
    }
}
