<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function register()
    {
        $roles=Role::all();
        return view('register', compact('roles'));
    }

    public function storeRegister(Request $request)
    {
        $user=User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect('/dashboard');
    }

    public function login()
    {
        return view('login');
    }

    public function storeLogin(Request $request)
    {
        $user=User::where('email', $request->email)->first();
        if($user)
        {
            if(Hash::check($request->password, $user->password)){
                if($user->hasRole('mahasiswa'))
                {
                    Auth::login($user);
                    return redirect('mahasiswa/');
                }elseif($user->hasRole('dosen'))
                {
                    Auth::login($user);
                    return redirect('dosen/');
                }
            }
            return redirect('login');
        }
        return redirect('login');
    }

    public function logout()
    {
        auth()->logout();
        Session::flush();
        return redirect('/');
    }
}
