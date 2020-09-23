<?php

namespace Database\Seeders;

use App\Models\Cake;
use App\Models\Component;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class CakesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::factory()->count(15)->create();
        Component::factory()->count(15)->create()
        ->each(function (Component $component){
            $component->ingredients()->sync(Ingredient::all()->shuffle()->first()->id);
        });
        Cake::factory()->count(10)->create()
            ->each(function (Cake $cake){
                $cake->components()->sync(Component::all()->shuffle()->shift());
            });
    }
}
