<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AddRoles;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(){
        $roles=Role::orderBy('id','DESC')->get();
        return view('admin.roles.index',compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(AddRoles $request)
    {
        $validator=Validator::make($request->all(),[]);

        if ($validator->fails()) {
            return redirect()->route('admin.roles.create')->withInput();
        }
        Role::create($request->all());
        return redirect()->route('admin.roles.index')->with('message', 'Role Created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }
}
