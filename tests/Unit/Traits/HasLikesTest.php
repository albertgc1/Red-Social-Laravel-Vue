<?php

namespace Tests\Unit\Traits;

use App\Like;
use Tests\TestCase;
use App\Traits\HasLikes;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasLikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_model_morph_many_likes()
    {
    	$model = new ModelWithLikes(['id' => 1]);

    	factory(Like::class)->create([
            'likeable_id' => $model->id,
            'likeable_type' => get_class($model)
        ]);

    	$this->assertInstanceOf(Like::class, $model->likes->first());
    }

    /** @test */
    public function user_can_like_and_unlike_model()
    {
        $this->withoutExceptionHandling();

        $model = new ModelWithLikes(['id' => 1]);
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $model->like();

        $this->assertDatabaseHas('likes', ['user_id' => $user->id]);

        $model->unLike();

        $this->assertDatabaseMissing('likes', ['user_id' => $user->id]);
    }

    /** @test */
    public function model_knows_it_was_liked()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $model = new ModelWithLikes(['id' => 1]);

        $this->actingAs($user);

        $this->assertEquals(false, $model->isLiked());

        $model->like();

        $this->assertEquals(true, $model->isLiked());

        $model->unLike();

        $this->assertEquals(false, $model->isLiked());
    }

    /** @test */
    public function model_knows_how_many_likes_have()
    {
        $this->withoutExceptionHandling();

        $model = new ModelWithLikes(['id' => 1]);

        //$this->assertEquals(0, $model->likesCount());

        factory(Like::class, 2)->create([
            'likeable_id' => $model->id,
            'likeable_type' => get_class($model)
        ]);

        $this->assertEquals(2, $model->likesCount());
    }
}

class ModelWithLikes extends Model
{
    use HasLikes;
    protected $fillable = ['id'];
}
