<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordLike extends Model
{
    protected $primaryKey = ['user_id', 'word_id'];
    public $incrementing = false;
    const UPDATED_AT = null;

    public function delete() {
        return self::query()
            ->where('user_id', '=', $this->user_id)
            ->where('word_id', '=', $this->word_id)
            ->delete();
    }

    public static function FindByUserAndWord($user_id, $word_id) {
        return self::query()
            ->where('user_id', '=', $user_id)
            ->where('word_id', '=', $word_id)
            ->first();
    }

    public static function FindWordLikesCount($word_id) {
        return self::query()
            ->where('word_id', '=', $word_id)
            ->count();
    }
}
