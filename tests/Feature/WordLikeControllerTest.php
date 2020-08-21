<?php

namespace Tests\Feature;

use App\Models\WordLike;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordLikeControllerTest extends TestCase
{
    /**
     * @group http
     * @group wordlike
     */
    public function test_toggle_like_word_success()
    {
        $word_id = 1;
        $existingLikes = WordLike::findWordLikesCount($word_id);
        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)
            ->json('POST', 'api/ajax/like', ['word_id' => $word_id]);

        $response->assertStatus(200)
            ->assertJson([
                'likes_count' => $existingLikes+1
            ]);

        $response = $this->actingAs($user)
            ->json('POST', 'api/ajax/like', ['word_id' => $word_id]);

        $response->assertStatus(200)
            ->assertJson([
                'likes_count' => $existingLikes
            ]);
    }

    /**
     * @group http
     * @group wordlike
     */
    public function test_toggle_like_word_fail_unauthorized() {
        $word_id = 1;
        $response = $this->json('POST', 'api/ajax/like', ['word_id' => $word_id]);
        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    /**
     * @group http
     * @group wordlike
     */
    public function test_toggle_like_word_fail_word_not_found() {
        $word_id = -1;
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)
            ->json('POST', 'api/ajax/like', ['word_id' => $word_id]);
        $response->assertStatus(400)
            ->assertJson([
                'error' => 'Could not find the word'
            ]);
    }

}
