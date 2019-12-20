<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{

    public function edit (): View
    {
        return view('dashboard.profile')->with('user', auth()->user());
    }

    public function update (Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            'password' => ['sometimes', 'nullable', 'string', 'min:8'],
        ]);
        $user = auth()->user();
        $input = $request->except('password');
        if (!$request->filled('password')) {
            $user->fill($input)->save();

            return back()->with('success', 'Ваш профиль успешно обновлен');
        }
        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back()->with('success', 'Ваш профиль и пароль успешно обновлены');
    }
}
