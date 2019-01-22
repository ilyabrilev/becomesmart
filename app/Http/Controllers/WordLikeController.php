<?php

namespace App\Http\Controllers;

use App\Models\GlossaryWord;
use App\Models\WordLike;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

class WordLikeController extends Controller
{
    public function ToggleLike(Request $request) {
        $request->validate([
            'word_id' => 'required|integer',
        ]);
        $word_id = $request->word_id;

        $user_id = Auth::id();
        if (!$user_id) {
            return response()->json(['error' => 'Could not find authenticated user'])->setStatusCode(401);
        }

        $likedWord = GlossaryWord::GetOrNull($word_id, $user_id);

        if (!$likedWord) {
            return response()->json(['error' => 'Could not find the word'])->setStatusCode(400);
        }

        if ($likedWord->is_current_user_like) {
            WordLike::DeleteByIds($user_id, $word_id);
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
            'likes_count'   => WordLike::FindWordLikesCount($word_id)
        ]);
    }

}
