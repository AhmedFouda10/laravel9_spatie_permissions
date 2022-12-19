<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPermissions;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index(){
        $permissions=Permission::orderBy('id','DESC')->get();
        return view('admin.permissions.index',compact('permissions'));
    }

    public function create(){
        return view('admin.permissions.create');
    }

    public function store(AddPermissions $request)
    {
        $validator=Validator::make($request->all(),[]);

        if ($validator->fails()) {
            return redirect()->route('admin.permissions.create')->withInput();
        }
        Permission::create($request->all());
        return redirect()->route('admin.permissions.index')->with('message', 'Permission Created successfully.');
    }



    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }
}
