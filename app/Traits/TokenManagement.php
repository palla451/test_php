<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

trait TokenManagement
{
    /**
     * @param $email
     * @param $password
     * @return string
     */
    public function getTokenRefreshToken($email, $password)
    {
        $baseUrl = env('APP_URL');
        $osClient = DB::table('oauth_clients')->where('id',2)->first();
        try {
            $response = Http::post($baseUrl."/oauth/token", [
                'username' => $email,
                'password' => $password,
                'client_id' => $osClient->id,
                'client_secret' => $osClient->secret,
                'grant_type' => 'password',
                'scope' => '',
            ]);

            return  json_decode($response->getBody(), true);

        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    /**
     * @param $refreshToken
     * @return mixed
     */
    public function getRefreshToken($refreshToken)
    {
        $baseUrl = url('/');
        $response =  Http::post("{$baseUrl}/oauth/token", [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'scope' => '',
        ]);


        // Verifica la risposta dalla richiesta di aggiornamento del token
        if ($response->successful()) {
            return $response->json();
        } else {
            // Gestisci eventuali errori dalla richiesta di aggiornamento del token
            return response()->json(['error' => 'Impossibile aggiornare il token'], $response->status());
        }
    }
}
