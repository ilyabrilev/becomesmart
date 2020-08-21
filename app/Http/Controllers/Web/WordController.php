<?php

namespace App\Http\Controllers\Web;

use App\Models\GlossaryWord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Контроллер слов
 *
 * Class WordController
 * @package App\Http\Controllers\Web
 */
class WordController extends Controller
{
    /**
     * Главная страница
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('pages.main', ['word' => new GlossaryWord(), 'moreButtonEnabled' => true, 'doLoadWord' => true]);
    }

    /**
     * Страница с конкретным словом, полученным по id.
     * Переход из списка слов по тегу
     *
     * @param GlossaryWord $word
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(GlossaryWord $word) {
        $word->load('tags')->withLikes(\Auth::id());
        return view('pages.main', ['word' => $word->toJson(), 'moreButtonEnabled' => false, 'doLoadWord' => false]);
    }
}
