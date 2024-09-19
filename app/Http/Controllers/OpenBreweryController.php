<?php

namespace App\Http\Controllers;

use App\Util\OpenBrewery;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OpenBreweryController extends Controller
{

    protected $open_brewery;

    public function __construct(OpenBrewery $open_brewery)
    {
        $this->open_brewery = $open_brewery;
    }


    public function index(Request $request)
    {

        return $this->open_brewery->getAllResults();
    }


}
