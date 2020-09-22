<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function store(User $recipient)
    {
        Friendship::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id
        ]);
    }

    public function update(User $sender, $denied = false)
    {
        Friendship::where([
            'sender_id' => $sender->id,
            'recipient_id' => auth()->id()
        ])->update([
            'status' => $denied ? 'denied' : 'accepted'
        ]);
    }

    public function destroy(User $recipient)
    {
        Friendship::where([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id,
        ])->delete();
    }
}
