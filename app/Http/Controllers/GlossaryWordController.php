<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Models\GlossaryWord;

class GlossaryWordController extends Controller
{
    public function Index() {
        $word = new GlossaryWord();
        return view('template-steak.main', ['word' => $word, 'moreButtonEnabled' => true, 'doLoadWord' => true]);
    }

    public function GetWordHtml(Request $request) {
        $word = $this->GetWordAbstract($request);
        return view('template-steak.main', ['word' => $word->toJson(), 'moreButtonEnabled' => false, 'doLoadWord' => false]);
    }

    public function GetWordJson(Request $request) {
        return $this->GetWordAbstract($request);
    }

    public function GetWordAbstract(Request $request) : GlossaryWord {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $word = new GlossaryWord();
        }
        else {
            $word = GlossaryWord::GetOrDefault($request->id);
        }
        return $word;
    }

    public function IndexNew() {
        return view('new.main', ['word' => '{}', 'moreButtonEnabled' => true]);
    }



}
