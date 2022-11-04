<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo asset('css/postShow.css')?>" type="text/css">
</head>
<body>
<x-layouts.base :title="$post->title">
    <div class="container">
        <div class="post">
            <div class="post-content">
                <div class="post-header">
                    <h1>{{ $post->title }}</h1>
                    <div class="post-meta">
                        <time datetime="2019-04-01">{{ date_format($post->created_at, 'd.m.Y H:i') }}</time>
                        <span class="author">{{ $post->user->name }}</span>
                        <span class="category">Философия</span>
                    </div>
                </div>
                <p>{{ $post->content }}</p>
            </div>
        </div>
    </div>
    <div class="mb-3">
        @can('update', $post)
            <a href="{{ route('posts.edit', [ $post->id ]) }}">Edit</a>
        @endcan
        @if($post->isAuthor() or auth()->user()->roles()->where('name', ['admin', 'moderator'])->exists())
            <x-form action="{{ route('posts.destroy', [ $post->id ]) }}" method="delete">
                <button> Delete </button>
            </x-form>
        @endif
    </div>
    <h2>Comments</h2>
    <x-comments.form for="post" :id="$post->id" />
    <hr>
    <x-comments.list :comments="$post->comments" />
</x-layouts.base>
</body>