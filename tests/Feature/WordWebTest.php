<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WordWebTest extends TestCase
{
    /**
     * @group http
     */
    public function test_get_main_page_seccess() {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @group http
     */
    public function test_get_specific_word_page_success() {
        $response = $this->get('/word?id=1');
        $response->assertStatus(200);
    }

    /**
     * @group http
     */
    public function test_get_specific_word_page_fail_wrong_parameter() {
        $response = $this->get('/word?id=asdsadasdas');
        $response->assertStatus(422);
    }

    /**
     * @group http
     */
    public function test_get_specific_word_page_fail_wrong_id() {
        $response = $this->get('/word?id=404');
        $response->assertStatus(404);
    }
}
