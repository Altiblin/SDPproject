<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\Save as SaveRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Helpers\ImageSaver;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Enums\Post\Status as PostStatus;

class Posts extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments')->orderByDesc('created_at')->paginate(4);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create', [
            'tags' => Tag::orderByDesc('title')->pluck('title', 'id')
        ]);
    }

    public function store(SaveRequest $request, Post $post)
    {
        $data = $request->validated();
        $data = [...$data, 'user_id' => $request->user()->id];
        $post = Post::create($data);
        $post->tags()->sync($data['tags']);
        
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = Tag::orderByDesc('title')->pluck('title', 'id');
        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(SaveRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $request->validated();  
        $post->update($data);
        $post->tags()->sync($data['tags']);
        return redirect()->route('posts.show', [ $post->id ]);
    }
    public function destroy($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
