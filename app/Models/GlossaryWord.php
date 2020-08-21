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
        return $this->hasMany(WordLike::class);
    }

    /**
     * //ToDo: убрать статику
     *
     * @param GlossaryWord|null $word
     * @param int|null $user_id
     */
    public static function withLikes(?GlossaryWord $word, ?int $user_id) {
        if ($word) {
            $word->likes_count = WordLike::findWordLikesCount($word->id);
            if ($user_id !== null) {
                $word->is_current_user_like = WordLike::findByUserAndWord($user_id, $word->id) ? true : false;
            }
        }
    }

    /**
     * Получение случайного слова
     * //ToDo: убрать в сервис
     *
     * @param null $user_id
     * @return GlossaryWord|null
     */
    public static function getRandomWord($user_id = null) : ?GlossaryWord {
        $word = self::with('tags')
            ->where('is_hidden', '=', 0)
            ->where('is_approved', '=', 1)
            ->inRandomOrder()
            ->first();
        self::withLikes($word, $user_id);
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
        self::withLikes($word, $user_id);
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
