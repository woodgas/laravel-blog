<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy() {
        $name = auth()->user()->name;
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye '. $name .'!');
    }

    public function create() {
        return view('sessions.create');
    }

    public  function store(Request $request) {


        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(!auth()->attempt($attributes)) {

            //        throw ValidationException::withMessages([
//            'email' => 'Your provided credentials could not be verified.'
//        ]);

            return back()->
            withInput()->
            withErrors(['email' => 'Your provided credentials could not be verified.']);
        }

        session()->regenerate();

        return redirect('/')->with('success', 'Welcome back!');
    }
}
