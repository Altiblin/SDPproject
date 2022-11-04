<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class RegisterController extends Controller {
    public function create() {
        return view('auth.register');
    }

    /**
     * Добавление пользователя
     */
    public function store(Request $request) {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now()
        ]);
        
        return redirect()
            ->route('login');
    }
}