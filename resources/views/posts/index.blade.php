<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo asset('css/posts.css')?>" type="text/css">
</head>
<body>
<x-layouts.base title="Наш блог">
    <h1 class="mt-2 mb-3">Все посты блога</h1>
        @foreach ($posts as $post)
        <div class="blog-card">
    <div class="meta">
      <div class="photo" style="background-image: url(https://storage.googleapis.com/chydlx/codepen/blog-cards/image-1.jpg)"></div>
      <ul class="details">
        <li class="author">Автор: {{ $post->user->name }}</li>
        <li class="date">Дата создания: {{ date_format($post->created_at, 'd.m.Y H:i') }}</li>
        <li class="tags">Тэги:  
          <x-tags.list :tags="$post->tags"/>
        </li>
      </ul>
    </div>
    <div class="description">
      <h1>{{ $post->title }}</h1>
      <p> {{ $post->content }}</p>
      <div>commets: {{ $post->comments_count }}</div>
      <p class="read-more">
        <a href="{{ route('posts.show', [ $post->id ] ) }}" class="nav-link">Читать дальше</a>
      </p>
    </div>
  </div>
        @endforeach
    {{ $posts->links() }}
</x-layouts.base>