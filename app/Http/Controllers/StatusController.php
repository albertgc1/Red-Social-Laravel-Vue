<?php

namespace App\Http\Controllers;

use App\Events\StatusCreated;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Resources\StatusResource;
use Illuminate\Support\Facades\Event;

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

        $statusResource = StatusResource::make($status);

        StatusCreated::dispatch($statusResource);

        return $statusResource;
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
