<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\Models\GlossaryWord;

class GlossaryWordController extends Controller
{
    public function Index() {
        $word = GlossaryWord::GetRandomWord();
        return view('template-steak.main', ['word' => $word, 'moreButtonEnabled' => true]);
    }

    public function GetHtml(Request $request) {

    }

    public function Get(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $word = new GlossaryWord();
        }
        else {
            $word = GlossaryWord::GetOrDefault($request->id);
        }
        return view('template-steak.main', ['word' => $word, 'moreButtonEnabled' => false]);
    }



}
