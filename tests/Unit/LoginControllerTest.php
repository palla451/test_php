<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        if (Auth::attempt(['username' => 'root', 'password' => 'password'])){
            $baseUrl = url('/');
            $user = Auth::user();
            $osClient = DB::table('oauth_clients')->where('id',2)->first();
            Http::post("{$baseUrl}/oauth/token", [
                'username' => $user->email,
                'password' => 'password',
                'client_id' => $osClient->id,
                'client_secret' => $osClient->secret,
                'grant_type' => 'password',
                'scope' => '',
            ]);

            echo 'credential valid';
            $this->assertTrue(true);
        }
        else
            $this->fail('credentials not valid');

    }
}
