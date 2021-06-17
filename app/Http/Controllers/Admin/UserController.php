<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{
    //constructor yg berisi middleware permission untuk mengakses method
    //di dalam controller ini
    public function __construct()
    {
        $this->middleware(['permission:users.index|users.create|users.edit|users.delete']);
    }

    //index halaman user
    public function index(Request $request){
        $users = User::latest()->when($request->keyword, function($users){
            $users = $users->where('name', 'like', '%'.request()->keyword.'%');
        })->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    //show create page with role option
    public function create()
    {
        $roles = Role::latest()->get();
        return view('admin.user.create', compact('roles'));
    }

    //save new user
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //set user ke role yang dipilih
        $user->assignRole($request->role);

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' =>
            'Data Berhasil Disimpan!']);
        }
        else{
            return redirect()->route('admin.user.index')->with(['error' =>
            'Data Gagal Disimpan!']);
        }
    }

    //show edit page
    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('admin.user.edit', compact('roles', 'user'));
    }

    //proses update
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required'
        ]);

        $user = User::findOrFail($user->id);

        if($request->password == ""){
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }
        else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }

        //assign ke role baru
        $user->syncRoles($request->role);

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' =>
            'Data Berhasil Diperbarui!']);
        }
        else{
            return redirect()->route('admin.user.index')->with(['error' =>
            'Data Gagal Disimpan!']);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if($user)
        {
            return response()->json([
                'status' => 'success'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }


}
