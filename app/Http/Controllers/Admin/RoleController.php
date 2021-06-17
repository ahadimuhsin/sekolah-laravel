<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //setting middleware yg bisa akses method role

    public function __construct()
    {
        $this->middleware(['permission:roles.index|rolse.create|roles.edit|roles.delete']);
    }

    public function index(Request $request)
    {
        $roles = Role::latest()->when($request->keyword, function($roles){
            $roles = $roles->where('name', 'like', '%'.request()->keyword.'%');
        })->paginate(5);

        return view('admin.role.index', compact('roles'));
    }

    //show add role page
    public function create()
    {
        $permissions = Permission::latest()->get();

        return view('admin.role.create', compact('permissions'));
    }

    //store new role
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create([
            'name' => $request->input('name')
        ]);

        //pasang permission ke role yg baru
        $role->syncPermissions($request->input('permissions'));

        if($role){
            return redirect()->route('admin.role.index')
            ->with(['success' => 'Data Berhasil Disimpan']);
        }
        else{
            return redirect()->route('admin.role.index')
            ->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    //show edit page
    public function edit(Role $role)
    {
        $permissions = Permission::latest()->get();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    //update function
    public function update(Request $request, Role $role)
    {
        $this->validate($request, [
            'name' => 'required|unique:name,'.$role->id
        ]);

        $role = Role::findOrFail($role->id);
        $role->update([
            'name' => $request->input('name')
        ]);

        //assign permission ke role
        $role->syncPermissions($request->input('permissions'));

        if($role){
            return redirect()->route('admin.role.index')
            ->with(['success' => 'Data Berhasil Diupdate']);
        }
        else{
            return redirect()->route('admin.role.index')
            ->with(['error' => 'Data Gagal Diupdate']);
        }
    }

    //hapus role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions;
        $role->revokePermissionTo($permissions);
        $role->delete();

        if($role){
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
