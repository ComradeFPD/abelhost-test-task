<?php

namespace Tests\Unit;

use App\Models\Cake;
use App\Models\Component;
use App\Models\Ingredient;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CakeTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test Can i create cake
     *
     * @return void
     */
    public function canICreateCake()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        Component::factory()->count(5)->create();
        $user->assignRole('designer');
        $this->actingAs($user);
        $cake = Cake::factory()->make()->toArray();
        $cake['components'] = [1, 2, 3];
        $response = $this->post(route('cake.store'), $cake);
        $response->assertStatus(204);
        $this->assertDatabaseHas('cakes', ['title' => $cake['title']]);

    }

    /**
     * @test Can i update existing cake
     *
     * @return void
     */
    public function canIUpdateCake()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $user->assignRole('designer');
        $this->actingAs($user);
        $cake = Cake::factory()->create()->toArray();
        Component::factory()->count(5)->create();
        $cake['components'] = [1, 2, 3];
        $cake['title'] = 'new title';
        $response = $this->put(route('cake.update', $cake['id']), $cake);
        $response->assertStatus(204);
        $this->assertDatabaseHas('cakes', ['title' => 'new title']);
    }

    /**
     * @test Can i view all cakes
     *
     * @return void
     */
    public function canIViewAllCake()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        Cake::factory()->count(19)->create();
        $response = $this->get(route('cake.index'));
        $response->assertStatus(200);
        $this->assertNotEmpty($response);
    }

    /**
     * @test Can i delete cake
     *
     * @return void
     */
    public function canIDeleteCake()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        $cake = Cake::factory()->create();
        $response = $this->delete(route('cake.destroy', $cake->id));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('cakes', ['id' => $cake->id]);
    }

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->seed(DatabaseSeeder::class);
    }
}
