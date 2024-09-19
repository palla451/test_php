<?php

namespace App\Util;

use GuzzleHttp\Client;

class OpenBrewery
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAllResults()
    {
        try {

            return  $this->client->request('GET', 'breweries', [
                'headers' => ['content-type' => 'application/json', 'accept' => 'application/ld+json']
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
