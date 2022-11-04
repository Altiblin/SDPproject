<?php

namespace App\Http\Controllers;

use App\Http\Requests\Videos\Save as SaveRequest;
use App\Models\Video;
use App\Models\Tag;
use App\Models\User;
use App\Helpers\ImageSaver;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class Videos extends Controller
{
    public function index()
    {
        $videos = Video::withCount('comments')->orderByDesc('created_at')->paginate(4);
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create', [
            'tags' => Tag::orderByDesc('title')->pluck('title', 'id')
        ]);
    }

    public function store(SaveRequest $request, Video $video)
    {

        $data = $request->validated();
        $data = [...$data, 'user_id' => $request->user()->id];
        $video = Video::create($data);
        
        $video->tags()->sync($data['tags']);
        
        return redirect()->route('videos.index');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $tags = Tag::orderByDesc('title')->pluck('title', 'id');
        return view('videos.edit', compact('video', 'tags'));
    }

    public function update(SaveRequest $request, $id)
    {
        $data = $request->validated();
        $video = Video::findOrFail($id);
        $video->update($data);
        $video->tags()->sync($data['tags']);
        return redirect()->route('videos.show', [ $video->id ]);
    }

    public function destroy($id) {
        $video = Video::findOrFail($id);
        $video->delete();
        return redirect()->route('videos.index');
    }
}
