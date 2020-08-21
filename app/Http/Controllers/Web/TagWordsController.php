<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\GlossaryTag;

/**
 * Контроллер списка слов по тегу
 *
 * Class WebTagWordsController
 * @package App\Http\Controllers\Web
 */
class TagWordsController extends Controller
{
    /**
     * Получение слов по тегу
     *
     * @param GlossaryTag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GlossaryTag $tag) {
        return view('pages.tagwords', ['tag' => $tag]);
    }
}
