<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChannelRequest;
use App\Channel;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('update');
    }

    public function show(Channel $channel)
    {
        return view('channel.show', compact('channel'));
    }

    public function update(ChannelRequest $request, Channel $channel)
    {
        if($request->hasFile('image')) {
            $channel->clearMediaCollection('images');

            $channel->addMediaFromRequest('image')
                ->toMediaCollection('images');
        }

        $channel->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return back();
    }
}
