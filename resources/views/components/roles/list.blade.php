@props([
    'roles'
])

@foreach($roles as $role)
        <td><em>{{ $role->name }}</em></td>
        <td><em>{{ $role->description }}</em></td>
@endforeach