<?php

namespace Tests\Unit;

use App\Models\GlossaryWord;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GlossaryWordModelTest extends TestCase
{
    /**
     * @group models
     */
    public function test_get_random_word_success()
    {
        $word = GlossaryWord::getRandom();
        $this->assertInstanceOf(GlossaryWord::class, $word);
    }

    /**
     * @group models
     */
    public function test_get_specific_word_found() {
        $word = GlossaryWord::getOrDefault(1);
        $this->assertEquals(1, $word->id);
    }

    /**
     * @group models
     */
    public function test_get_specific_word_default() {
        $word = GlossaryWord::getOrDefault(-9999);
        $this->assertEquals(-1, $word->id);
    }
}
