<x-layouts.base title="Пользователи">
    @if ($users->count())
    <h1>Все пользователи блога</h1>    
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th width="45%">Имя</th>
                <th width="45%">Почта</th>
                <th width="45%">Роль</th>
                <th width="45%">Описание роли</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <x-roles.list :roles="$user->roles" />
                
                <td>
                    <a href="{{ route('users.edit', [ $user->id ]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <x-form action="{{ route('users.destroy', [ $user->id ]) }}" method="DELETE">
                        <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                            <i class="far fa-trash-alt text-danger"></i>
                        </button>
                    </x-form>
                </td>
            </tr>
            @endforeach
        </table>
    @endif
    {{ $users->links() }}
</x-layouts.base>