<?php

namespace Tests\Unit;

use App\Models\WordLike;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordLikeModelTest extends TestCase
{
    /**
     * @group models
     */
    public function test_create_and_delete_a_like()
    {
        $user_id = 0;
        $word_id = 0;

        WordLike::DeleteByIds($user_id, $word_id);
        $this->CheckIfWordIsNotExists($user_id, $word_id);

        $newWord = new WordLike();
        $newWord->user_id = 0;
        $newWord->word_id = 0;
        $newWord->save();

        $this->CheckIfWordIsExists($user_id, $word_id);

        $newWord->delete();

        $this->CheckIfWordIsNotExists($user_id, $word_id);
    }

    private function CheckIfWordIsNotExists($user_id, $word_id) {
        $isfounded = WordLike::FindByUserAndWord($user_id, $word_id);
        $this->assertEmpty($isfounded);
        $count = WordLike::FindWordLikesCount($word_id);
        $this->assertEquals(0, $count);
    }

    private function CheckIfWordIsExists($user_id, $word_id) {
        $isfounded = WordLike::FindByUserAndWord($user_id, $word_id);
        $this->assertEquals($word_id, $isfounded->word_id);
        $count = WordLike::FindWordLikesCount($word_id);
        $this->assertEquals(1, $count);
    }
}
