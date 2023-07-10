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
                'data.author',
                'data.article',
                'data.created_at',
                'data.updated_at',
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
                'data.body',
                'data.author_id',
                'data.article_id',
                'data.updated_at',
                'data.created_at',
            ])
        );
    }

    /**
     * A basic feature test example.
     */
    public function test_remove_a_comment(): void
    {
        $comment = Comment::factory()->create();

        $response = $this->delete($this->base.'/destroy/'.$comment->id);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.author_id',
                'data.article_id',
            ])
         );
    }

    /**
     * A basic feature test example.
     */
    public function test_updating_a_comment(): void
    {
         $comment = Comment::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Article::factory()->create(), 'article')
            ->create();

        $response = $this->putJson($this->base.'/update/'.$comment->id, ['body' => 'Updated the comment.']);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.author_id',
                'data.article_id',
            ])
        );
    }

    /**
     * A basic feature test example.
     */
    public function test_storing_a_comment(): void
    {
         $comment = Comment::factory()
            ->for(User::factory()->create(), 'author')
            ->for(Article::factory()->create(), 'article')
            ->make();

        $response = $this->postJson($this->base.'/store', $comment->toArray());

        $response->assertStatus(201)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll([
                'data.id',
                'data.body',
                'data.author_id',
                'data.article_id',
            ])
        );
    }
}
