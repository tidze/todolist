<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutMe extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('aboutme_2');
    }
}
