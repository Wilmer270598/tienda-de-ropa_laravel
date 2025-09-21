<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $usuario = Usuario::where('nombre', $request->nombre)->first();

    if ($usuario && Hash::check($request->password, $usuario->contraseña)) {
        Auth::loginUsingId($usuario->id_usuario);
        return redirect()->route('pantalla.inicial');
    }

    return back()->with('error', 'Usuario o contraseña incorrectos');
}
public function logout()
{
    auth()->logout();
    return redirect()->route('login');
}




    
}

