<?php

namespace Tests\Unit\Http\Resources;

use App\Comment;
use Tests\TestCase;
use App\Http\Resources\CommentResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_comment_resource_have_the_neccesary_fields()
    {
        $comment = factory(Comment::class)->create();

        $commentResource = CommentResource::make($comment)->resolve();

        $this->assertEquals($comment->id, $commentResource['id']);
        $this->assertEquals($comment->body, $commentResource['body']);
        $this->assertEquals($comment->user->name, $commentResource['user_name']);
        $this->assertEquals($comment->user->link(), $commentResource['user_link']);
        $this->assertEquals('https://iupac.org/wp-content/uploads/2018/05/default-avatar.png', $commentResource['user_avatar']);
        $this->assertEquals($comment->created_at->diffForHumans(), $commentResource['ago']);
    }
}
