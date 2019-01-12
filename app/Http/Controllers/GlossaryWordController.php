<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Models\GlossaryWord;

class GlossaryWordController extends Controller
{
    public function Index() {
        return view('template-steak.main', ['word' => '{}', 'moreButtonEnabled' => true]);
    }

    public function GetHtml(Request $request) {
        $word = $this->GetAbstract($request);
        return view('template-steak.main', ['word' => $word, 'moreButtonEnabled' => false]);
    }

    public function GetJson(Request $request) {
        return $this->GetAbstract($request);
    }

    public function GetAbstract(Request $request) : GlossaryWord {
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



}
