<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlossaryWord extends Model
{
    public function tags()
    {
        return $this->belongsToMany(GlossaryTag::class);
    }

    public static function GetRandomWord() : ?GlossaryWord {
        $word = self::where('is_hidden', '=', 0)->inRandomOrder()->first();
        return $word;
    }
}
