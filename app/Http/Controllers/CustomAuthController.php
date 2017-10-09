<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LogIn;
use App\Http\Requests\Register;
use Auth;
use App\Models\User;

class CustomAuthController extends Controller
{
    public function login(LogIn $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('inicio');
        }else {
            return back()->withErrors(['Estas credenciales no coinciden con nuestros registros.'])->withInput();
        }
    }

    public function register(Register $request)
    {
        User::create($request->all());

        return response()->json([
            'success' => 'Tu registro se realizó correctamente.'
        ]);
    }
}
