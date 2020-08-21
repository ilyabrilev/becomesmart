<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GlossaryWord;
use App\Models\WordLike;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

/**
 * Контроллер для лайков слов
 *
 * Class WordLikeController
 * @package App\Http\Controllers
 */
class WordLikeController extends Controller
{
    /**
     * Переключение лайков
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Request $request) {
        //ToDo: проверить авторизацию, убрать валидацию в реквест, добавить слово как параметр функции
        $request->validate([
            'word_id' => 'required|integer',
        ]);
        $word_id = $request->word_id;

        $user_id = Auth::id();
        if (!$user_id) {
            return response()->json(['error' => 'Can\'t find authenticated user'])->setStatusCode(401);
        }

        $likedWord = GlossaryWord::getOrNull($word_id, $user_id);

        if (!$likedWord) {
            return response()->json(['error' => 'Can\'t find the word'])->setStatusCode(400);
        }

        if ($likedWord->is_current_user_like) {
            WordLike::deleteByIds($user_id, $word_id);
            $userLiked = false;
        }
        else {
            $newLike = new WordLike();
            $newLike->user_id = $user_id;
            $newLike->word_id = $word_id;
            $newLike->save();
            $userLiked = true;
        }

        return response()->json([
            'user_liked'    => $userLiked,
            'likes_count'   => WordLike::findWordLikesCount($word_id)
        ]);
    }

}
