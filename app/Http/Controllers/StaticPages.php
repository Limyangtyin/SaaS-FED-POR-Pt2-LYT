<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class StaticPages extends Controller
{
    public function welcome()
    {
        $listings = Listing::latest()->limit(6)->get();
        return view('pages/welcome', compact(['listings']));
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
