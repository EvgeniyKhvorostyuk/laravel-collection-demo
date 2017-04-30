<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\SuccessRegistered;

class RegisterController extends Controller
{
    public function create()
    {
        return view('user.register');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        auth()->login($user);

        \Mail::to($user)->send(new SuccessRegistered($user));

        return redirect()->home();
    }
}
