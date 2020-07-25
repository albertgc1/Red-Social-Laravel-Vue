<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;
use App\Http\Resources\StatusResource;

class StatusController extends Controller
{
    public function index()
    {
        $status = Status::latest()->paginate();

        return StatusResource::collection($status);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|min:5'
        ]);

        $status = Status::create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        return StatusResource::make($status);
    }

    public function show(Status $status)
    {
        //
    }

    public function edit(Status $status)
    {
        //
    }

    public function update(Request $request, Status $status)
    {
        //
    }

    public function destroy(Status $status)
    {
        //
    }
}
