<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlossaryWord extends Model
{

    protected $attributes = [
        'id'            => -1,
        'word'          => 'Слово не найдено',
        'definition'    => '',
        'is_hidden'     => 0,
        'link_for_more' => '#',
        'author'        => 0,
        'tags'          => [],
        'likes_count'   => 0,
        'is_current_user_like' => false
    ];

    public function tags()
    {
        return $this->belongsToMany(GlossaryTag::class);
    }

    public function likes() {
        return $this->hasMany(WordLike::class);
    }

    public static function WithLikes($word, $user_id) {
        if ($word) {
            $word->likes_count = WordLike::FindWordLikesCount($word->id);
            $word->is_current_user_like = WordLike::FindByUserAndWord($user_id, $word->id) ? true : false;
        }
    }

    public static function GetRandomWord($user_id = null) : ?GlossaryWord {
        $word = self::with('tags')
            ->where('is_hidden', '=', 0)
            ->where('is_approved', '=', 1)
            ->inRandomOrder()
            ->first();
        self::WithLikes($word, $user_id);
        return $word;
    }

    public static function GetOrDefault(int $id, $user_id = null) : GlossaryWord {
        $word = self::GetOrNull($id, $user_id);
        if (!$word) {
            $word = new self();
        }
        return $word;
    }

    public static function GetOrNull(int $id, $user_id = null) : ?GlossaryWord {
        $word = self::with('tags')
            ->where('is_hidden', '=', 0)
            ->where('is_approved', '=', 1)
            ->find($id);
        self::WithLikes($word, $user_id);
        return $word;
    }

}
