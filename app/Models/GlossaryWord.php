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
        'tags'          => []
    ];

    public function tags()
    {
        return $this->belongsToMany(GlossaryTag::class);
    }

    public static function GetRandomWord() : ?GlossaryWord {
        $word = self::with('tags')
            ->where('is_hidden', '=', 0)
            ->inRandomOrder()
            ->first();
        return $word;
    }

    public static function GetOrDefault(int $id) : GlossaryWord {
        $word = self::with('tags')
            ->where('is_hidden', '=', 0)
            ->find($id);
        if (!$word) {
            $word = new self();
        }
        return $word;
    }

}
