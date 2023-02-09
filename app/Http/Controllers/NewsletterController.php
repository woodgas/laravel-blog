<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Request $request, Newsletter $newsletter) {

        // Newsletter $newsletter is an interface and called as an "automatic resolution feature"

        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $newsletter->subscribe($request->input('email'));
        }
        catch (\Exception $e) {
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our news list.',
            ]);
        }
        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }
}
