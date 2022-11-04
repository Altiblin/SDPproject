<x-layouts.base title="Теги блога">
    <h1>Все теги блога</h1>
    <a href="{{ route('tags.create') }}" class="btn btn-success mb-4">Добавить тег</a>
    
    @if ($tags->count())
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th width="45%">Наименование</th>
                <th width="45%">url</th>
                <th width="45%">Читать</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->url }}</td>
                <td><a href="{{ route('tags.show', [ $tag->id ]) }}" class="nav-link link-dark" >more...</a></td>
                <td>
                    <a href="{{ route('tags.edit', [ $tag->id ]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <x-form action="{{ route('tags.destroy', [ $tag->id ]) }}" method="DELETE">
                        <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                            <i class="far fa-trash-alt text-danger"></i>
                        </button>
                    </x-form>
                </td>
            </tr>
            @endforeach
        </table>
    @endif
    {{ $tags->links() }}
</x-layouts.base>