<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Слово
 *
 * Class GlossaryWord
 * @package App\Models
 */
class GlossaryWord extends Model
{
    /**
     * Ссылка на вики для получения описания
     *
     * @var string
     */
    const WIKI_LINK_FOR_MORE_URL = 'https://ru.wiktionary.org/wiki/';

    /**
     * Атрибуты по умолчанию
     *
     * @var array
     */
    protected $attributes = [
        'id'            => -1,
        'word'          => 'Слово не найдено',
        'definition'    => '',
        'is_hidden'     => 0,
        'is_approved'   => 1,
        'link_for_more' => '#',
        'author'        => 0,
        'tags'          => [],
        'likes_count'   => 0,
        'is_current_user_like' => false
    ];

    /**
     * Связь с тегами
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(GlossaryTag::class);
    }

    /**
     * Связь с лайками
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes() {
        return $this->hasMany(WordLike::class, 'word_id');
    }

    /**
     * Добавление параметра is_current_user_like
     *
     * @param int|null $user_id
     */
    public function withLikes(?int $user_id) {
        $this->likes_count = $this->likes->count();
        if ($user_id !== null) {
            $this->is_current_user_like = $this->likes->where('user_id', '=', $user_id)->count() > 0;
        } else {
            $this->is_current_user_like = false;
        }
    }

    /**
     * Получение случайного слова
     *
     * @param null $user_id
     * @return GlossaryWord|null
     */
    public static function getRandom($user_id = null) : ?GlossaryWord {
        $word = self::with('tags')
            ->where('is_hidden', '=', 0)
            ->where('is_approved', '=', 1)
            ->inRandomOrder()
            ->first();
        if ($word) {
            $word->withLikes($user_id);
        }
        return $word;
    }

    /**
     * Поиск или новое слово
     * //ToDo: переписать под FirstOrNew
     *
     * @param int $id
     * @param null $user_id
     * @return GlossaryWord
     */
    public static function getOrDefault(int $id, $user_id = null) : GlossaryWord {
        $word = self::getOrNull($id, $user_id);
        if (!$word) {
            $word = new self();
        }
        return $word;
    }

    /**
     * Поиск слова или null
     *
     * @param int $id
     * @param null $user_id
     * @return GlossaryWord|null
     */
    public static function getOrNull(int $id, $user_id = null) : ?GlossaryWord {
        $word = self::with('tags')
            ->where('is_hidden', '=', 0)
            ->where('is_approved', '=', 1)
            ->find($id);
        if ($word) {
            $word->withLikes($user_id);
        }
        return $word;
    }

    /**
     * Поиск слова по названию
     *
     * @param string $name
     * @return GlossaryWord|null
     */
    public static function searchWordUsingName(string $name) : ?GlossaryWord{
        return self::where('word', 'LIKE', $name)
            ->first();
    }
}
