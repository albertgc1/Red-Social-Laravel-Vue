<?php

namespace Tests\Unit\Http\Resources;

use App\Comment;
use Tests\TestCase;
use App\Http\Resources\UserResource;
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
        $this->assertEquals($comment->created_at->diffForHumans(), $commentResource['ago']);

        $this->assertInstanceOf(
            UserResource::class,
            $commentResource['user']
        );
    }
}
