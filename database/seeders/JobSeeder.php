<?php

namespace Database\Seeders;

use App\Models\Job;
use Database\Factories\JobFactory;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobFactory::factoryForModel(Job::class)->create();
    }
}
