<?php

namespace App\Http\Controllers;

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
            return response()->json(['error' => 'Could not find authenticated user']);
        }

        $isLikeExists = WordLike::FindByUserAndWord($user_id, $word_id);

        if ($isLikeExists) {
            $isLikeExists->delete();
        }
        else {
            $newLike = new WordLike();
            $newLike->user_id = $user_id;
            $newLike->word_id = $word_id;
            $newLike->save();
        }

        return response()->json(['likes_count' => WordLike::FindWordLikesCount($word_id)]);
    }

}