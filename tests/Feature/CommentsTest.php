<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    public $base = '/api/v1/comment';

    /**
     * A basic feature test example.
     */
    public function test_get_show_data(): void
    {
        $comment = Comment::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Article::factory()->create(), 'article')
            ->create();

        $response = $this->getJson($this->base.'/show/'.$comment->id);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.author.name',
                'data.is_visible',
            ])
            );
    }

    /**
     * A basic feature test example.
     */
    public function test_get_edit_data(): void
    {
        $comment = Comment::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Article::factory()->create(), 'article')
            ->create();

        $response = $this->getJson($this->base.'/edit/'.$comment->id);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                //'data.body',
                //'data.author.name',
                //'data.is_visible',
            ])
            );
    }

    // /**
    //  * A basic feature test example.
    //  */
    // public function test_remove_a_article(): void
    // {
    //     $article = Article::factory()->create();

    //     $response = $this->delete($this->base.'/destroy/'.$article->id);

    //     $response->assertStatus(200);
    // }

    // /**
    //  * A basic feature test example.
    //  */
    // public function test_updating_a_article(): void
    // {
    //     $article = Article::factory()
    //         ->for(User::factory()->create(), 'author')
    //         ->for(Category::factory()->create(), 'category')
    //         ->create();

    //     $response = $this->putJson($this->base.'/update/'.$article->id, $article->toArray());

    //     $response->assertStatus(200)
    //         ->assertJson(fn (AssertableJson $json) => $json->hasAll([
    //             'data.id',
    //             'data.body',
    //             'data.title',
    //             'data.author',
    //             'data.category',
    //         ])
    //     );

    //     // Re-send to fail validation
    //     $article = Article::factory()->create([
    //         'title' => 'Updated'
    //     ]);

    //     $response = $this->putJson($this->base.'/update/'.$article->id, $article->toArray());

    //     $response->assertStatus(422);
    // }

    // /**
    //  * A basic feature test example.
    //  */
    // public function test_storing_a_article(): void
    // {
    //     $article = Article::factory()
    //         ->for(User::factory()->create(), 'author')
    //         ->for(Category::factory()->create(), 'category')
    //         ->make();

    //     $response = $this->postJson($this->base.'/store', $article->toArray());

    //     $response->assertStatus(201)
    //      ->assertJson(fn (AssertableJson $json) => $json->hasAll([
    //             'data.id',
    //             'data.body',
    //             'data.title',
    //             'data.author',
    //             'data.category',
    //         ])
    //     );
    // }
}
