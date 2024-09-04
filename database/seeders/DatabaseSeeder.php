<?php

namespace Database\Seeders;

use App\Practice;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use App\Models\Sheet;
use App\Models\Screen;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SheetTableSeeder::class);
        $this->call(ScreenTableSeeder::class);

        // Genre::factory()->count(3)->create();
        // Movie::factory()->count(3)->create();
        // Schedule::factory()->count(6)->create();
    }
}
