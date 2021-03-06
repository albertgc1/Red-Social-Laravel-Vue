<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\User;

class FriendshipController extends Controller
{
    public function index()
    {
        $friendships = Friendship::with('sender')->where('recipient_id', auth()->id())->get();

        return view('users.friendships', compact('friendships'));
    }

    public function store(User $recipient)
    {
        if(auth()->id() === $recipient->id){
            abort(404);
        }

        Friendship::firstOrCreate([
            'sender_id' => auth()->id(),
            'recipient_id' => $recipient->id
        ]);

        return response()->json(['friendship_status' => 'pending']);
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
        ])->orWhere([
            'sender_id' => $recipient->id,
            'recipient_id' => auth()->id(),
        ])->delete();

        return response()->json(['friendship_status' => 'deleted']);
    }
}
