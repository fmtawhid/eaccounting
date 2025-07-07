<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/customer/dashboard';
    protected function redirectTo()
    {
        if (Auth::user()->isAdmin()) {
            return '/panel/dashboard';
        } elseif (Auth::user()->isStudent()) {
            return '/panel/studentD';
        }

        return '/panel/dashboard';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Handle the login request.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    // public function login(Request $request)
    // {
    //     // Validate the incoming request for email or dhakila number
    //     $request->validate([
    //         'email' => 'required_without:dhakila_number|email',
    //         'dhakila_number' => 'required_without:email|string',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     // Determine whether to use email or dhakila_number for login
    //     $credentials = [];

    //     if ($request->has('email')) {
    //         $credentials = ['email' => $request->email, 'password' => $request->password];
    //     } elseif ($request->has('dhakila_number')) {
    //         // If Dhakila Number is provided, check if user with that Dhakila Number exists
    //         $user = \App\Models\User::where('student_dhakila_number', $request->dhakila_number)->first();

    //         if ($user) {
    //             // If a user is found, set credentials with the found user's email and password
    //             $credentials = ['email' => $user->email, 'password' => $request->password];
    //         } else {
    //             // If no user found with Dhakila Number, return error
    //             return back()->withErrors(['dhakila_number' => 'Invalid Dhakila Number or Password.']);
    //         }
    //     }

    //     // Attempt login with credentials
    //     if (Auth::attempt($credentials, $request->remember)) {
    //         $this->authenticated($request, Auth::user());
    //         return $this->sendLoginResponse($request);
    //     }

    //     // If login attempt fails, return error message
    //     return $this->sendFailedLoginResponse($request);
    // }
}