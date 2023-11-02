<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.user.index', compact('users'));
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
            'locationName' => 'string',
        ]);
        $attributes = $request->all();
        Location::create($attributes);

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
            'locationName' => 'string',

        ]);

        $attributes = $request->all();
        $location->update($attributes);
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
