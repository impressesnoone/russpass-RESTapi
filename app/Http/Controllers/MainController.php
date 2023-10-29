<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('app');
    }
}
