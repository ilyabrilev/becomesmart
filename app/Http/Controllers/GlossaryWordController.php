<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\GlossaryWord;
use \Illuminate\Support\Facades\Auth;

class GlossaryWordController extends Controller
{
    public function Index() {
        $word = new GlossaryWord();
        return view('new.main', ['word' => $word, 'moreButtonEnabled' => true, 'doLoadWord' => true]);
    }

    public function GetWordHtml(Request $request) {
        $word = $this->GetWordAbstract($request);
        return view('new.main', ['word' => $word->toJson(), 'moreButtonEnabled' => false, 'doLoadWord' => false]);
    }

    public function GetWordAbstract(Request $request) : GlossaryWord {
        $validator = \Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $word = new GlossaryWord();
        }
        else {
            $word = GlossaryWord::GetOrDefault($request->id, Auth::id());
        }
        return $word;
    }

    public function GetRandomWordJson() {
        return GlossaryWord::GetRandomWord(Auth::id());
    }

    public function GetWordJson(Request $request) {
        return $this->GetWordAbstract($request);
    }

    public function AddNewWord() {

    }
}
