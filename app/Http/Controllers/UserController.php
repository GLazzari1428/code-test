<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Mostra o formulário para editar o perfil do utilizador.
     */
    public function edit()
    {
        return view('user.profile', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Atualiza as informações do perfil do utilizador.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.edit')->with('toast', 'Perfil atualizado com sucesso!');
    }
}
