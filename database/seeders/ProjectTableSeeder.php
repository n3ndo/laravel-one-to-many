<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Generator as Faker;
use App\Models\Project;
class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 25; $i++){
            $project = new Project();
            $project->title = $faker->words(3, true);
            $project->content = $faker->text(400);
            $project->slug = Str::slug($project->title, '-');
            $project->save();
        }
    }
}
