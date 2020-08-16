<?php

namespace App\Http\Resources;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
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
            'ago' => $this->created_at->diffForHumans(),
            'likes' => $this->likesCount(),
            'is_liked' => $this->isLiked(),
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
