<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create() {
       return view('account.create');
    }

    public function store() {

//         return(request()->all());

        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:users,name'],
            'username' => ['required', 'min:3', 'max:255',  'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:255'],
        ]);

        $user =  User::create($attributes);

//        Auth::login($user);
//        session()->flash('success', 'Your account have been created.');
//        return redirect('/');

        auth()->login($user);
        return redirect('/')->with('success', 'Your account have been created.');

    }

    public function edit() {
        return view('account.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request) {

        $attributes = $request->validate([
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')->ignore(auth()->user()->id)],
            'name' => ['required', 'min:3', 'max:255', Rule::unique('users', 'username')->ignore(auth()->user()->id)],
            'password' => ['required', 'min:7', 'max:255'],
            'thumbnail' => ['image']
        ]);

        if($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
        auth()->user()->update($attributes);
        return back()->with('success', 'Account data updated!');
    }
}
