<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = Site::paginate(5);
        return view('admin.site.index', compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $locations = Location::get(['id','locationName']);
        return view('admin.site.create',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $image = $request->file('image')->store(
            'sites/images', 'public'
        );
        Site::create($request->except('image') + ['image' => $image]);

        return redirect()->route('sites.index')->with([
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
    public function edit(Site $site)
    {
        $locations = Location::get(['id','locationName']);
        return view('admin.site.edit',compact('site','locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'siteName' => 'string|max:255',
            'description' => 'string',

        ]);

        if ($request->hasFile('image')) {
            File::delete('storage/' . $site->image);
            $image = $request->file('image')->store('sites/images', 'public');
            $site->update($request->except('image') + ['image' => $image]);
        } else {
            $site->update($request->validated());
        }

        return redirect()->route('sites.index')->with([
            'message' => 'Success Updated!',
            'alert-type' => 'info'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        File::delete('storage/'. $site->image);
        $site->delete();

        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }

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
