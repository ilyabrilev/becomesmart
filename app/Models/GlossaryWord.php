<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlossaryWord extends Model
{
    public static function GetRandomWord() : ?GlossaryWord {
        return self::where('is_hidden', '=', 0)->inRandomOrder()->first();
    }
}
