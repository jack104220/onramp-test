<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tags;
use App\Models\TagRecords;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Tags::factory(20)->create()->each(function($tag) {
            TagRecords::factory(10)
                ->state(['object_id' => $tag->object_id])
                ->create();
        });
    }
}
