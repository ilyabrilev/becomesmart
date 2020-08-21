<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WordResource;
use App\Models\GlossaryWord;

/**
 * Контроллер слов
 *
 * Class WordController
 * @package App\Http\Controllers\Api
 */
class WordController extends Controller
{
    /**
     * Получение слова в формате json
     *
     * @return WordResource
     */
    public function random() {
        //return GlossaryWord::getRandom(\Auth::id());
        return new WordResource(GlossaryWord::getRandom(\Auth::id()));
    }

    /**
     * Получение конкретного слова в json
     *
     * @param GlossaryWord $word
     * @return WordResource
     */
    public function show(GlossaryWord $word) {
        return new WordResource($word->withLikes(\Auth::id()));
    }
}
