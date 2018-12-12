<?php

namespace Tests\Feature;

use App\Models\GlossaryWord;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GlossaryWordModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_random_word_success()
    {
        $word = GlossaryWord::GetRandomWord();
        $this->assertInstanceOf(GlossaryWord::class, $word);
    }

    public function test_get_specific_word_found() {
        $word = GlossaryWord::GetOrDefault(1);
        $this->assertEquals(1, $word->id);
    }

    public function test_get_specific_word_default() {
        $word = GlossaryWord::GetOrDefault(-9999);
        $this->assertEquals(-1, $word->id);
    }
}
