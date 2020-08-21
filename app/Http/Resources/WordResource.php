<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Слово
 *
 * Class WordResource
 * @package App\Http\Resources
 */
class WordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'definition'    => $this->definition,
            'is_current_user_like' => $this->is_current_user_like,
            'word'          => $this->word,
            'likes_count'   => $this->likes_count,
            'link_for_more' => $this->link_for_more,
            'tags'          => TagResource::collection($this->tags),
        ];
    }
}
