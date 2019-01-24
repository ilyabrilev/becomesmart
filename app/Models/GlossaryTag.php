<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlossaryTag extends Model
{
    public function words() {
        return $this->belongsToMany(GlossaryWord::class);
    }

    public function SearchTagsFromArray(array $tags_ids) {
        //self::query()->whereIn('id')
    }
}
