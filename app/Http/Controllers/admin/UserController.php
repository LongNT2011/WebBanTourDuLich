<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'Không được để trống!',
            'email' => 'Nhập đúng định dạng email!',
            'unique' => 'Email đã tồn tại!'
        ];
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ], $message);
        $user = new User();
        $user->fullName = $request->fullName;
        $user->email = trim($request->email);
        $user->password = trim(Hash::make($request->password));
        $user->remember_token = Str::random(40);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->isAdmin = $request->isAdmin;
        $user->save();
        return redirect()->route('users.index');


    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->except('remember_token', 'email_verified_at'));
        return redirect()->route('users.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->order()->count() > 0) {
            Toastr::error('Không thể xóa người dùng này!');
            return redirect()->back();
        }
        $user->delete();
        Toastr::success('Xóa người dùng thành công!');

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('email', 'like', "%$query%")
            ->orWhere('fullName', 'like', "%$query%")
            ->orWhere('phoneNumber', 'like', "%$query%")
            ->paginate(5);

        return view('admin.user.index', compact('users'));

    }
}
