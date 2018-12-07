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
}
