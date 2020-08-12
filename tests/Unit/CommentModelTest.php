<?php

namespace Tests\Unit;

use App\User;
use App\Comment;
use Tests\TestCase;
use App\Traits\HasLikes;
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
    public function a_comment_model_must_use_the_trait_has_likes()
    {
        $uses = class_uses(Comment::class);
        
        $this->assertArrayHasKey(HasLikes::class, $uses);
    }
}
