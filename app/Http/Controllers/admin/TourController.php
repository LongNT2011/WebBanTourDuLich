<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Site;
use App\Models\Tour;
use App\Models\TourImage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::paginate(5);
        return view('admin.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $sites = Site::get(['id','siteName']);
        return view('admin.tour.create',compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tourName' => 'required',
            'sites' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image')->store(
            'tours/images', 'public'
        );
        $tour = Tour::create($request->except('image') + ['image' => $image]);
        $tour->site()->sync($request->sites);
        Toastr::success('Thêm tour thành công!' );
        return redirect()->route('tours.index')->with([
            'message' => 'Success Created !',
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
    public function edit(Tour $tour)
    {
        $sites = Site::get(['id','siteName']);
        return view('admin.tour.edit',compact('tour','sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'tourName' => 'required',
            'sites' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            File::delete('storage/' . $tour->image);
            $image = $request->file('image')->store('tours/images', 'public');
            $tour->update($request->except('image') + ['image' => $image]);
            $tour->site()->sync($request->sites);
        } else {
            $tour->update($request);
            $tour->site()->sync($request->sites);

        }
        Toastr::success('Sửa tour thành công!' );
        return redirect()->route('tours.index')->with([
            'message' => 'Success Updated!',
            'alert-type' => 'info'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        if($tour->tourDetail->count() > 0){
            Toastr::error('Không thể xóa tour này!' );
            return redirect()->back();
        }
        File::delete('storage/'. $tour->image);
        $tour->site()->detach();
        $tour->delete();
        Toastr::success('Xóa tour thành công!' );
        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $tours = Tour::where('tourName', 'like', "%$query%")
            ->paginate(5);

        return view('admin.tour.index', compact('tours'));

    }
}
