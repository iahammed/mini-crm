<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function loginForm()
    {
        return view('auth.login');
    }
    
    
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect()->intended('login');   
    }

    /**
     * Handle an authentication for spa(auth:sanctum)
     * @ return json with token
     */
    public function spalogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('token-spa');
            return $token->plainTextToken;
        }
        return response()->json([
            'statue'    => 500,
            'message'   => 'Unauthorize'
        ]);    
    }
    /**
     * Handle spa(auth:sanctum) to remove token
     */
    public function spalogout()
    {   
        $user = Auth::user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        
        return response()->json([
            'statue'    => 200,
            'message'   => 'Logout success'
        ]); 
    }

}