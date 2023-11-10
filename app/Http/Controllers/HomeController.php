<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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

    public function detail(TourDetail $detail){
      $hotels = Hotel::join('sites', 'hotels.site_id','=', 'sites.id' )
      ->join('tour_site', 'sites.id','=','tour_site.site_id')
      ->join('tours', 'tour_site.tour_id','=','tours.id')
      ->join('tourdetails', 'tours.id','=','tourdetails.tour_id')
      -> where('tourdetails.id', $detail -> id)
      -> get(['hotels.id', 'hotels.hotelName', 'hotels.pricePerPerson']);
      return view('hotel-single', compact('detail', 'hotels'));
    }

    // public function bookingTour(){

    // }

    public function searchTour(){
      $tours = DB::table('tours')
    ->join('tour_site', 'tours.id', '=', 'tour_site.tour_id')
    ->join('sites', 'tour_site.site_id', '=', 'sites.id')
    ->join('locations', 'sites.location_id', '=', 'locations.id')
//    ->where('locations.id', '=', $location)
    ->get();
    return view('index', compact('tours'));
    }

    public function tour(){
      $tours = Tour::with('tourDetail')->paginate(9);
      return view('tour', compact('tours'));
    }

}
