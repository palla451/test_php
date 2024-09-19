<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OpenBreweryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_list_brewery(): void
    {
        $url = env('BASE_URI').'breweries';
        try {
            $results = Http::get($url);
            $response = json_decode($results->getBody());
            echo 'success connect to openbrewerydb';
            $this->assertTrue(true);
        }catch (\Exception $exception){
            echo 'success connect to openbrewerydb';
            $this->fail('error connection to openbrewerydb');
        }


    }
}
