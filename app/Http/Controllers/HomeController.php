<?php

namespace App\Http\Controllers;
use App\Models\Site;
use App\Models\Tour;
use App\Models\Location;
use App\Models\TourDetail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sites = Site::all();
        $tours = Tour::with('tourDetail')->latest()->take(5)->get();
        $locations = Location::all();
        return view('index', compact('sites', 'tours', 'locations'));
    }

    public function detail(TourDetail $detail)
    {
        //  dd($detail);
        return view('hotel-single', compact('detail'));
    }

}
