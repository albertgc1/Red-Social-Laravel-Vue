<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Status;
use Illuminate\Http\Request;

class StatusCommentController extends Controller
{
    public function store(Request $request, Status $status)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = $status->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        return CommentResource::make($comment);
    }
}
