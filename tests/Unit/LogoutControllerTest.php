<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_logout(): void
    {
        if (Auth::attempt(['username' => 'root', 'password' => 'password'])){
            DB::table('oauth_access_tokens')->truncate();

            echo 'success logout';
            $this->assertTrue(true);
        }
        else
            $this->fail('logout failed');
    }
}
