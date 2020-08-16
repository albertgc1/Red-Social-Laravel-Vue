<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'id' => $this->id,
            'body' => $this->body,
            'user_name' => $this->user->name,
            'user_link' => $this->user->link(),
            'user_avatar'=> 'https://iupac.org/wp-content/uploads/2018/05/default-avatar.png',
            'likes' => $this->likesCount(),
            'is_liked' => $this->isLiked(),
            'ago' => $this->created_at->diffForHumans(),
        ];
    }
}
