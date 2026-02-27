<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }
    public function store(Request $request)
    {
        $formfields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);
        //HASH PASSWORD
        $formfields['password'] = bcrypt($formfields['password']);

        //CREATE USER
        $user = User::create($formfields);
        //LOGIN

        auth()->login($user);

        return redirect('/')
            ->with('success', 'User Created and Logged in Successfully!');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been Logged Out');
    }
    public function login()
    {
        return view('users.login');
    }
    public function authenticate(Request $request)
    {
        $formfields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth()->attempt($formfields)) {
            $request->session()
                ->regenerate();
            return redirect('/')
                ->with('success', 'You are now Logged In');
        }
        return back()
            ->withErrors(['email' => 'Invalid Credentials'])
            ->onlyInput('email');
    }
}
