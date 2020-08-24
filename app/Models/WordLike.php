<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Лайк для слова
 *
 * Class WordLike
 * @package App\Models
 */
class WordLike extends Model
{
    /**
     * Составной ключ
     * @var array
     */
    protected $primaryKey = ['user_id', 'word_id'];

    /**
     * Нет инкрементного id
     * @var bool
     */
    public $incrementing = false;

    /**
     *
     */
    const UPDATED_AT = null;

    /**
     * Удаление лайка
     *
     * @return bool|mixed|null
     */
    public function delete() {
        return self::deleteByIds($this->user_id, $this->word_id);
    }

    /**
     * Удаление лайков
     *
     * @param $user_id
     * @param $word_id
     * @return mixed
     */
    public static function deleteByIds($user_id, $word_id) {
        return self::query()
            ->where('user_id', '=', $user_id)
            ->where('word_id', '=', $word_id)
            ->delete();
    }

    /**
     * Получение количества лайков для слова
     * //ToDo: использовать relation
     *
     * @param $word_id
     * @return int
     */
    public static function findWordLikesCount($word_id) {
        return self::query()
            ->where('word_id', '=', $word_id)
            ->count();
    }
}
