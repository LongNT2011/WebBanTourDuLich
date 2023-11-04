<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::paginate(5);
        return view('admin.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'locationName' => 'required',
        ]);
        $attributes = $request->all();
        Location::create($attributes);
        Toastr::success('Thêm vị trí thành công!' );
        return redirect()->route('locations.index')->with([
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
    public function edit(Location $location)
    {

        return view('admin.location.edit',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'locationName' => 'required',
        ]);

        $attributes = $request->all();
        $location->update($attributes);
        Toastr::success('Sửa vị trí thành công!' );
        return redirect()->route('locations.index')->with([
            'message' => 'Success Updated!',
            'alert-type' => 'info'
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        Toastr::success('Xóa vị trí thành công!' );
        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $locations = Location::where('locationName', 'like', "%$query%")
            ->paginate(5);

        return view('admin.location.index', compact('locations'));

    }
}
