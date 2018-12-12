<?php

namespace Tests\Feature;

use App\Http\Controllers\GlossaryWordController;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GlossaryWordControllerTest extends TestCase
{

    public function test_get_specific_word_page_success() {
        $request = Request::create('/word', 'GET', [
            'id' => 1
        ]);
        $controller = new GlossaryWordController();
        $response = $controller->GetAbstract($request);
        $this->assertEquals(1, $response->id);
    }

    public function test_get_specific_word_page_fail_wrong_parameter() {
        $request = Request::create('/word', 'GET', [
            'id' => 'assasdasdas'
        ]);
        $controller = new GlossaryWordController();
        $response = $controller->GetAbstract($request);
        $this->assertEquals(-1, $response->id);
    }

    public function test_get_specific_word_page_fail_wrong_id() {
        $request = Request::create('/word', 'GET', [
            'id' => '999999999999999999999999'
        ]);
        $controller = new GlossaryWordController();
        $response = $controller->GetAbstract($request);
        $this->assertEquals(-1, $response->id);
    }
}
