<?php

namespace Tests\Unit;

use App\Models\Ingredient;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->seed(DatabaseSeeder::class);
        $this->user = User::factory()->create();
        $this->user->assignRole('baker');
    }

    /**
     * @test Can i create ingredient
     *
     * @return void
     */
    public function canICreateIngredient()
    {
        $this->actingAs($this->user);
        $ingredient = Ingredient::factory()->make()->toArray();
        $response = $this->post(route('ingredient.store'), $ingredient);
        $response->assertStatus(204);
        $this->assertDatabaseHas('ingredients', ['title' => $ingredient['title']]);
    }

    /**
     * @test Can i update ingredient
     *
     * @reutn void
     */
    public function canIUpdateIngredient()
    {
        $this->actingAs($this->user);
        $ingredient = Ingredient::factory()->create()->toArray();
        $ingredient['title'] = 'new title';
        $response = $this->put(route('ingredient.update', $ingredient['id']), $ingredient);
        $response->assertStatus(204);
        $this->assertDatabaseHas('ingredients', ['title' => $ingredient['title']]);
    }

    /**
     * @test Can i delete ingredient
     *
     * @return void
     */
    public function canIDeleteIngredient()
    {
        $this->actingAs($this->user);
        $ingredient = Ingredient::factory()->create();
        $response = $this->delete(route('ingredient.destroy', $ingredient->id));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('ingredients', ['id' => $ingredient->id]);
    }

    /**
     * @test Can i view all ingredients
     *
     * @return void
     */
    public function canIViewAllIngredients()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('ingredient.index'));
        $response->assertStatus(200);
        $this->assertNotNull($response->content());
    }

    /**
     * @test Can't create new ingredient without baker role
     *
     * @return void
     */
    public function cantCreateIngredientWithoutBakerRole()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $ingredient = Ingredient::factory()->make()->toArray();
        $response = $this->post(route('ingredient.store'), $ingredient);
        $response->assertStatus(401);
        $this->assertDatabaseMissing('ingredients', ['title' => $ingredient['title']]);
    }
}
