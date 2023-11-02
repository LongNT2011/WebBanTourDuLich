<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\TourDetail;
use App\Models\TourImage;
use Illuminate\Http\Request;

class TourImageController extends Controller
{

    public function store(Request $request, TourDetail $tourDetail)
    {
        $request->validate([
            'imageUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $images = $request->file('imageUrl')->store(
            'tourdetails/images', 'public'
        );
        TourImage::create($request->except('imageUrl') + ['imageUrl' => $images,'tourDetail_id' => $tourDetail->id]);

    }


    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
