<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPages extends Controller
{
    public function welcome()
    {
        return view('pages/welcome');
    }

    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact-us');
    }

    public function pricing()
    {
        return view('pages/pricing');
    }

}
