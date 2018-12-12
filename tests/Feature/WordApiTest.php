<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordApiTest extends TestCase
{
    /**
     * @group http
     * @return void
     */
    public function test_get_main_page_seccess() {
        $response = $this->get('/api/random');
        $response->assertStatus(200);
    }


    /**
     * @group http
     */
    public function test_get_specific_word_page_success() {
        $response = $this->get('api/word?id=1');
        $response->assertStatus(200)
            ->assertJson(['id' => 1]);
    }

    /**
     * @group http
     */
    public function test_get_specific_word_page_fail_wrong_parameter() {
        $response = $this->get('api/word?id=asdsadasdas');
        $response->assertStatus(200)
            ->assertJson(['id' => -1]);
    }

    /**
     * @group http
     */
    public function test_get_specific_word_page_fail_wrong_id() {
        $response = $this->get('api/word?id=-99999999999');
        $response->assertStatus(200)
            ->assertJson(['id' => -1]);
    }

}
