<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Models\GlossaryWord;
use \Illuminate\Support\Facades\Auth;

class GlossaryWordController_Old extends Controller
{
    public function Index() {
        $word = new GlossaryWord();
        return view('template-steak.main', ['word' => $word, 'moreButtonEnabled' => true, 'doLoadWord' => true]);
    }

    public function GetWordHtml(Request $request) {
        $gvc = new GlossaryWordController();
        $word = $gvc->GetWordAbstract($request);
        return view('template-steak.main', ['word' => $word->toJson(), 'moreButtonEnabled' => false, 'doLoadWord' => false]);
    }
}
