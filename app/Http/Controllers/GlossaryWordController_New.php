<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Models\GlossaryWord;

class GlossaryWordController_New extends Controller
{
    public function Index() {
        $word = new GlossaryWord();
        return view('new.main', ['word' => $word, 'moreButtonEnabled' => true, 'doLoadWord' => true]);
    }

    public function GetWordHtml(Request $request) {
        $gwc = new GlossaryWordController();
        $word = $gwc->GetWordAbstract($request);
        return view('new.main', ['word' => $word->toJson(), 'moreButtonEnabled' => false, 'doLoadWord' => false]);
    }
}
