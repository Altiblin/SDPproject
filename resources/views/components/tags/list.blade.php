@props([
    'tags'
])

@foreach($tags as $tag)
    {{ $tag->title }}, 
@endforeach