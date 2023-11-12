<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Site;
use Brian2694\Toastr\Facades\Toastr;
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
        $message = ['required' => 'Không được để trống!',
            'image' => 'Phải là hình ảnh!'
        ];
        $request->validate([
            'siteName'=> 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],$message);
        $image = $request->file('image')->store(
            'sites/images', 'public'
        );
        Site::create($request->except('image') + ['image' => $image]);
        Toastr::success('Thêm địa danh thành công!' );
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
        $message = ['required' => 'Không được để trống!',
            'image' => 'Phải là hình ảnh!'
        ];
        $request->validate([
            'siteName'=> 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],$message);

        if ($request->hasFile('image')) {
            File::delete('storage/' . $site->image);
            $image = $request->file('image')->store('sites/images', 'public');
            $site->update($request->except('image') + ['image' => $image]);
        } else {
            $site->update($request->except('image'));
        }
        Toastr::success('Sửa địa danh thành công!' );

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
        if($site->tour->count() > 0){
            Toastr::error('Không thể xóa địa danh này!' );

            return redirect()->back();
        }

        File::delete('storage/'. $site->image);
        $site->delete();
        Toastr::success('Xóa địa danh thành công!' );
        return redirect()->back()->with([
            'message' => 'Success Deleted !',
            'alert-type' => 'danger'
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $sites = Site::where('siteName', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->paginate(5);

        return view('admin.site.index', compact('sites'));

    }
}
