<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\Save as SaveRequest;
use App\Models\User;
use App\Models\Role;
use App\Enums\Post\Status as PostStatus;

class Users extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->paginate(10);
        $roles = Role::orderByDesc('created_at');
        return view('users.index', compact('users', 'roles'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderByDesc('created_at')->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(SaveRequest $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $user->update($data);
        $user->roles()->sync($data['roles']);
        return redirect()->route('users.show', [ $user->id ]);
    }
}
