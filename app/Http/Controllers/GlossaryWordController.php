<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\GlossaryWord;
use \Illuminate\Support\Facades\Auth;

/**
 * Контроллер слов
 *
 * //ToDo: поделить на web и api
 *
 * Class GlossaryWordController
 * @package App\Http\Controllers
 */
class GlossaryWordController extends Controller
{
    /**
     * Главная страница
     * ToDo: Web
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $word = new GlossaryWord();
        return view('pages.main', ['word' => $word, 'moreButtonEnabled' => true, 'doLoadWord' => true]);
    }

    /**
     * Страница с конкретным словом, полученным по id.
     * Переход из списка слов по тегу
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWordHtml(Request $request) {
        $word = $this->getWordAbstract($request);
        return view('pages.main', ['word' => $word->toJson(), 'moreButtonEnabled' => false, 'doLoadWord' => false]);
    }

    /**
     * Получение слова по id, либо дефолтного слова
     * //ToDo: в сервис, убрать валидатор и щависимость от request
     *
     * @param Request $request
     * @return GlossaryWord
     */
    public function getWordAbstract(Request $request) : GlossaryWord {
        $validator = \Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $word = new GlossaryWord();
        }
        else {
            $word = GlossaryWord::getOrDefault($request->id, Auth::id());
        }
        return $word;
    }

    /**
     * Получение слова в формате json
     * //ToDo: Api
     * //ToDo: использовать resource
     *
     * @return GlossaryWord|null
     */
    public function getRandomWordJson() {
        return GlossaryWord::getRandomWord(Auth::id());
    }

    /**
     * Получение конкретного слова в json
     * //ToDo: Api
     *
     * @param Request $request
     * @return GlossaryWord
     */
    public function getWordJson(Request $request) {
        return $this->getWordAbstract($request);
    }

    /**
     * Проверка существования слова
     * //ToDo: Не используется
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkIfWordExists(Request $request) {
        $request->validate([
            'word'          => 'required|string|max:255'
        ]);

        $searchResult = GlossaryWord::searchWordUsingName($request->word);
        if ($searchResult) {
            return $this->getResponseIfWordDoesExists($searchResult);
        }
        return response()->json(['message' => 'word not found :)']);
    }

    /**
     * ToDo: удалить
     *
     * @param $searchResult
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResponseIfWordDoesExists($searchResult) {
        $status = 'The word is approved and displaying';
        if ($searchResult->is_hidden === 1) {
            $status = 'The word is hidden from public eyes for some reason';
        }
        if ($searchResult->is_approved === 0) {
            $status = 'The word was already suggested but wasn\'t approved yet';
        }
        return response()->json(['errors' => ['word' => "Such word exists in the database. Status: $status"]])->setStatusCode(400);
    }

    /**
     * Добавление нового слова
     * //ToDo: не используется
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addNewWord(Request $request) {
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
        $searchResult = GlossaryWord::searchWordUsingName($request->word);
        if ($searchResult) {
            return $this->getResponseIfWordDoesExists($searchResult);
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

    /**
     * //ToDo: раелизация
     */
    public function ApproveAWord() {

    }
}
