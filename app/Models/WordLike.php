<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordLike extends Model
{
    protected $primaryKey = ['user_id', 'word_id'];
    public $incrementing = false;
    const UPDATED_AT = null;

    public function delete() {
        return self::DeleteByIds($this->user_id, $this->word_id);
    }

    public static function DeleteByIds($user_id, $word_id) {
        return self::query()
            ->where('user_id', '=', $user_id)
            ->where('word_id', '=', $word_id)
            ->delete();
    }

    public static function FindByUserAndWord($user_id, $word_id) {
        if ($user_id !== null) {
            return self::query()
                ->where('user_id', '=', $user_id)
                ->where('word_id', '=', $word_id)
                ->first();
        }
        return null;
    }

    public static function FindWordLikesCount($word_id) {
        return self::query()
            ->where('word_id', '=', $word_id)
            ->count();
    }
}
