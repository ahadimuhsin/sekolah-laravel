<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //constructor
    //untuk mengatur hanya user yg diizinkan mengakses menu permission yg bisa mengakses
    public function __construct()
    {
        $this->middleware(['permission:permissions.index']);
    }

    public function index()
    {
        $permissions = Permission::latest()->when(request()->keyword,
        function($permissions){
            $permissions = $permissions->where('name', 'like', '%'.request()->keyword.'%');
        })->paginate(5);

        return view('admin.permission.index', compact('permissions'));
    }

}
