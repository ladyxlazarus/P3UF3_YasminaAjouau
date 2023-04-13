<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            // autenticar al usuario con las credenciales proporcionadas
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return Redirect::route('events.index');
            }
        } catch (\PDOException $e) {
            // error de conexión a la base de datos
            throw ValidationException::withMessages([
                'email' => 'Error: No se puede establecer una conexión con la base de datos. Revisa tu conexión.',
            ]);
        }

        // error de validación
        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Autenticar al usuario, cuando se registra ya entra en el index de eventos
        Auth::login($user);

        return redirect()->route('events.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
