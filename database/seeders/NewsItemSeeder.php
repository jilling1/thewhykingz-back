<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;
use Carbon\Carbon;

class NewsItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 15; $i++) {
            DB::table('news_items')->insert([
                'title' => Str::random(5),
                'short_description' => Str::random(10),
                'full_description' => Str::random(100),
                'status' => $faker->randomElement(['active', 'hidden']),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

    }
}
