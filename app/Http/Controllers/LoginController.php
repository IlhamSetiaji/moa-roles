<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function register()
    {
        $roles=Role::all();
        return view('register', compact('roles'));
    }

    public function storeRegister(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'name'=>'required|max:255|string',
            'username' => 'required|alpha_dash|unique:users,username',
            'email'=>'required|email|unique:users',
            'password' => 'min:8|required_with:password-confirmation|same:password-confirmation',
            'password-confirmation' => 'min:8',
        ]);
        if($validator->fails()){
            return redirect('register')->withInput()->withErrors($validator);
        }
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
        $input=$request->all();
        $validator=Validator::make($input,[
            'email'=>'required|email',
            'password' => 'min:8|required',
        ]);
        if($validator->fails()){
            return redirect('login')->withInput()->withErrors($validator);
        }
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
