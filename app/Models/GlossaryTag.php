<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Теги слова
 *
 * Class GlossaryTag
 * @package App\Models
 */
class GlossaryTag extends Model
{
    /**
     * Связь со словами
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function words() {
        return $this->belongsToMany(GlossaryWord::class);
    }
}
