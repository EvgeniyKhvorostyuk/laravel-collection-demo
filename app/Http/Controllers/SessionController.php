<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['destroy']);
    }

    public function create()
    {
    	return view('user.login');
    }

    public function store()
    {
    	if (!auth()->attempt(request(['email', 'password']))) {

    		return back()->withErrors([

    			'message' => 'Please check your entered data'

			]); 

        } else {

			return redirect()->home();
		}    
	}

    public function destroy()
    {
    	auth()->logout();

    	return redirect()->home();
    }
}
