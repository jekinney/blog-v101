<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    public $base = '/api/v1/article';

    /**
     * A basic feature test example.
     */
    public function test_get_show_data(): void
    {
        $article = Article::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Category::factory()->create(), 'category')
            ->create();

        $response = $this->getJson($this->base.'/show/'.$article->id);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.title',
                'data.author',
                'data.category',
                'data.publish_at',
                'data.expires_at',
                'data.updated_at',
                'data.created_at',
                'data.header_image',
                'data.is_draft',
                'data.is_featured',
            ])
            );
    }

    /**
     * A basic feature test example.
     */
    public function test_get_edit_data(): void
    {
        $article = Article::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Category::factory()->create(), 'category')
            ->create();

        $response = $this->getJson($this->base.'/edit/'.$article->id);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.title',
                'data.author',
                'data.category',
                'data.publish_at',
                'data.expires_at',
                'data.updated_at',
                'data.created_at',
                'data.header_image',
                'data.is_draft',
                'data.is_featured',
            ])
            );
    }

    /**
     * A basic feature test example.
     */
    public function test_remove_a_article(): void
    {
        $article = Article::factory()->create();

        $response = $this->delete($this->base.'/destroy/'.$article->id);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     */
    public function test_updating_a_article(): void
    {
        $article = Article::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Category::factory()->create(), 'category')
            ->create();

        $response = $this->putJson($this->base.'/update/'.$article->id, $article->toArray());

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.title',
                'data.author',
                'data.category',
            ])
            );

        // Re-send to fail validation
        $article = Article::factory()->create([
            'title' => 'Updated',
        ]);

        $response = $this->putJson($this->base.'/update/'.$article->id, $article->toArray());

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     */
    public function test_storing_a_article(): void
    {
        $article = Article::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Category::factory()->create(), 'category')
            ->make();

        $response = $this->postJson($this->base.'/store', $article->toArray());

        $response->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.title',
                'data.author',
                'data.category',
            ])
            );
    }
}
