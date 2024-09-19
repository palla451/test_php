<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\TokenManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    use TokenManagement;

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $response = $this->getTokenRefreshToken($user->email, $request->password);
            return $response;
        }else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function validateToken(Request $request)
    {
        // Verifica se l'utente è autenticato
        if (Auth::check()) {
            // Se l'utente è autenticato, il token è valido
            return response()->json(['message' => 'Token is valid'], 200);
        } else {
            // Se l'utente non è autenticato, il token è invalido
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }

    public function logout(Request $request)
    {
        // Recupera il token dell'utente autenticato
        $token = $request->user()->token();

        // Revoca il token, invalidando l'autenticazione dell'utente
        $token->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
