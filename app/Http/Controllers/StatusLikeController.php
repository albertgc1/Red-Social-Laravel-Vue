<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusLikeController extends Controller
{
    public function store(Status $status)
    {
    	$status->likes()->firstOrCreate([
    		'user_id' => auth()->id()
    	]);
    }
}
