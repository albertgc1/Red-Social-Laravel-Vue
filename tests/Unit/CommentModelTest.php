<?php

namespace Tests\Unit;

use App\User;
use App\Comment;
use App\Like;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_comment_belongs_to_user()
    {
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $comment->user);
    }

    /** @test */
    public function a_comment_morph_many_likes()
    {
        $comment = factory(Comment::class)->create();

        factory(Like::class)->create([
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment)
        ]);

        $this->assertInstanceOf(Like::class, $comment->likes->first());
    }
}
