<?php

namespace Database\Seeders;

use App\Practice;
use App\Models\Movie;
use App\Models\Sheet;

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
    }
}
