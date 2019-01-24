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

    public function CheckIfWordExists(Request $request) {
        $request->validate([
            'word'          => 'required|string|max:255'
        ]);

        $searchResult = GlossaryWord::SearchWordUsingName($request->word);
        if ($searchResult) {
            return $this->GetResponseIfWordDoesExists($searchResult);
        }
        return response()->json(['message' => 'word not found :)']);
    }

    public function GetResponseIfWordDoesExists($searchResult) {
        $status = 'The word is approved and displaying';
        if ($searchResult->is_hidden === 1) {
            $status = 'The word is hidden from public eyes for some reason';
        }
        if ($searchResult->is_approved === 0) {
            $status = 'The word was already suggested but wasn\'t approved yet';
        }
        return response()->json(['errors' => ['word' => "Such word exists in the database. Status: $status"]])->setStatusCode(400);
    }

    public function AddNewWord(Request $request) {
        $request->validate([
            'word'          => 'required|string|max:255',
            'definition'    => 'required|string',
            'tags'          => 'array'
        ]);

        $user_id = Auth::id();
        if (!$user_id) {
            return response()->json(['error' => 'Could not find authenticated user'])->setStatusCode(401);
        }

        //проверка, существует ли слово
        $searchResult = GlossaryWord::SearchWordUsingName($request->word);
        if ($searchResult) {
            return $this->GetResponseIfWordDoesExists($searchResult);
        }

        //проверка, валиден ли url для дополнительной информации
        $link_for_more = GlossaryWord::WIKI_LINK_FOR_MORE_URL . $request->word;
        if ($request->link_for_more) {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', $request->link_for_more, []);
            if ($res->getStatusCode() === 200) {
                $link_for_more = $request->link_for_more;
            }
            else {
                return response()->json(['errors' => ['link_for_more' => 'url for more information is either unreachable or invalid']])->setStatusCode(400);
            }
        }

        //сохранение слова
        $word = new GlossaryWord();
        $word->word  = $request->word;
        $word->definition = $request->definition;
        $word->link_for_more = $link_for_more;
        $word->is_approved = 0;
        $word->author = $user_id;
        $word->save();

        //сохранение связи слово-тег

    }

    public function ApproveAWord() {

    }
}
