<?php

namespace App\Http\Controllers;

use App\Models\GlossaryWord;
use App\Models\WordLike;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

/**
 * Controller for "WordLike" model
 *
 * Class WordLikeController
 * @package App\Http\Controllers
 */
class WordLikeController extends Controller
{
    public function toggleLike(Request $request) {
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
