<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TravelPackageRequest;
use App\Models\Gallery;
use App\Models\Location;
use App\Models\Site;
use App\Models\Tour;
use App\Models\TourDetail;
use App\Models\TourImage;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TourDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tourdetails = TourDetail::paginate(5);
        return view('admin.tourdetail.index', compact('tourdetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $tours = Tour::get(['id','tourName']);
        return view('admin.tourdetail.create',compact('tours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('imageUrl')) {
            $imagePaths = [];

            foreach ($request->file('imageUrl') as $image) {
                $imagePath = $image->store('tourdetails/images', 'public');
                $imagePaths[] = $imagePath;
            }
        } else {
            $imagePaths = [];
        }

        $tourDetailData = $request->except('imageUrl');

        $tourdetail = TourDetail::create($tourDetailData);

        foreach ($imagePaths as $imagePath) {
            TourImage::create([
                'imageUrl' => $imagePath,
                'tour_detail_id' => $tourdetail->id
            ]);
        }

        return redirect()->route('tourdetails.index')->with([
            'message' => 'Success Created!',
            'alert-type' => 'success'
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourDetail $tourdetail)
    {
        $tours = Tour::get(['id','tourName']);
        return view('admin.tourdetail.edit',compact('tourdetail','tours'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TourDetail $tourdetail)
    {
        if ($request->hasFile('imageUrl')) {
            $imagePaths = [];
            foreach ($request->file('imageUrl') as $image) {
                $imagePath = $image->store('tourdetails/images', 'public');
                $imagePaths[] = $imagePath;
            }

        } else {

            $imagePaths[] = [];
        }

        $tourdetail->update($request->except('imageUrl'));
        foreach ($imagePaths as $imagePath) {
            File::delete('storage/' . $imagePath);
            foreach ($tourdetail->tourimage as $tourImage) {
                $tourImage->update([
                    'imageUrl' => $imagePath,
                    'tour_detail_id' => $tourdetail->id
                ]);
            }

        }

        return redirect()->route('tourdetails.index')->with([
            'message' => 'Success Updated!',
            'alert-type' => 'info'
        ]);

    }


    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(TourDetail $tourDetail)
//    {
//        $tourDetail->delete();
//
//        return redirect()->back()->with([
//            'message' => 'Success Deleted !',
//            'alert-type' => 'danger'
//        ]);
//    }

//    public function search(Request $request)
//    {
//        $query = $request->input('query');
//
//        $hotels = Hotel::where('hotelName', 'like', "%$query%")
//            ->orWhere('description', 'like', "%$query%")
//            ->orWhere('pricePerPerson', 'like', "%$query%")
//            ->paginate(5);
//
//        return view('admin.hotel.index', compact('hotels'));
//
//    }
}
