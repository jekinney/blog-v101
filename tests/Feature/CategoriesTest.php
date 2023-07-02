<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    public $base = '/api/v1/category';

    /**
     * A basic feature test example.
     */
    public function test_getting_a_select_list_of_categories(): void
    {
        $category = Category::factory()->create();

        $response = $this->getJson($this->base.'/select');

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data', 1, fn (AssertableJson $json) => $json->where('id', $category->id)
                ->where('name', $category->name)
                ->missing('created_at')
                ->missing('updated_at')
                ->missing('articles_count')
            )
            );
    }

    /**
     * A basic feature test example.
     */
    public function test_get_show_data(): void
    {
        $category = Category::factory()->create();

        $response = $this->getJson($this->base.'/show/'.$category->id);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.name',
                'data.created_at',
                'data.updated_at',
                'data.articles_count',
            ])
            );
    }

    /**
     * A basic feature test example.
     */
    public function test_get_edit_data(): void
    {
        $category = Category::factory()->create();

        $response = $this->getJson($this->base.'/edit/'.$category->id);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.name',
                'data.created_at',
                'data.updated_at',
                'data.articles_count',
            ])
            );
    }

    /**
     * A basic feature test example.
     */
    public function test_remove_a_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->delete($this->base.'/destroy/'.$category->id);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     */
    public function test_updating_a_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->putJson($this->base.'/update/'.$category->id, [
            'name' => 'Updated',
        ]);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.name',
                'data.created_at',
                'data.updated_at',
                'data.articles_count',
            ])
            );

        // Re-send to fail validation
        $response = $this->putJson($this->base.'/update/'.$category->id, [
            'name' => 'Updated',
        ]);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     */
    public function test_storing_a_category(): void
    {
        $response = $this->postJson($this->base.'/store', [
            'name' => 'Created',
        ]);

        $response->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.name',
                'data.created_at',
                'data.updated_at',
                'data.articles_count',
            ])
            );

        // Sned again to fail Validation
        $response = $this->postJson($this->base.'/store', [
            'name' => 'Created',
        ]);

        $response->assertStatus(422);
    }
}
