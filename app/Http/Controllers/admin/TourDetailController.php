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
use Brian2694\Toastr\Facades\Toastr;
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
//        $tourdetails = TourDetail::paginate(5);
//        return view('admin.tourdetail.index', compact('tourdetails'));
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
        $message = ['required' => 'Không được để trống!',
            'image' => 'Phải là hình ảnh!'
        ];
        $request->validate([
            'checkInDate' => 'required',
            'checkOutDate' => 'required',
            'vehicle' => 'required',
            'maxParticipant' => 'required',
            'childrenPrice' => 'required',
            'adultPrice' => 'required',
            'depatureLocation' => 'required',
            'tripDescription' => 'required',
            'imageUrl' => 'required|array|min:1',
            'imageUrl.*' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ],$message);
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
        Toastr::success('Thêm chi tiết tour thành công!' );
        foreach ($imagePaths as $imagePath) {
            TourImage::create([
                'imageUrl' => $imagePath,
                'tour_detail_id' => $tourdetail->id
            ]);
        }

        return redirect()->route('tours.show', ['tour' => $tourdetail->tour]);
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
        $message = ['required' => 'Không được để trống!',
            'image' => 'Phải là hình ảnh!'
        ];
        $request->validate([
            'checkInDate' => 'required',
            'checkOutDate' => 'required',
            'vehicle' => 'required',
            'maxParticipant' => 'required',
            'childrenPrice' => 'required',
            'adultPrice' => 'required',
            'depatureLocation' => 'required',
            'tripDescription' => 'required',
            'imageUrl.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],$message);
        $imagePaths = [];

        if ($request->hasFile('imageUrl')) {
            foreach ($tourdetail->tourimage as $tourImage) {
                $oldPath = $tourImage->imageUrl;
                File::delete('storage/' . $oldPath);
            }

            foreach ($request->file('imageUrl') as $image) {
                $imagePath = $image->store('tourdetails/images', 'public');
                $imagePaths[] = $imagePath;
            }

            $tourdetail->tourimage()->delete();
            foreach ($imagePaths as $imagePath) {
                $tourdetail->tourimage()->create([
                    'imageUrl' => $imagePath,
                ]);
            }
        }

        $tourdetail->update($request->except('imageUrl'));
        Toastr::success('Sửa chi tiết tour thành công!' );
        return redirect()->route('tours.show', ['tour' => $tourdetail->tour]);

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourDetail $tourdetail)
    {

        $tourdetail->delete();
        Toastr::success('Xóa chi tiết tour thành công!' );
        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }

//    public function search(Request $request, Tour $tour)
//    {
//        $query = $request->input('query');
//
//        $tourdetails = TourDetail::where('tour_id', '=', "%$tour->id%")
//            ->orWhere('depatureLocation', 'like', "%$query%")
//            ->orWhere('checkInDate', 'like', "%$query%")
//            ->paginate(5);
//
//        return view('admin.tourdetail.index', compact('tourdetails'));
//
//    }
}
