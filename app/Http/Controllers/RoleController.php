<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.role.index')->only('index');
        $this->middleware('can:admin.role.create')->only('create','store');
        $this->middleware('can:admin.role.edit')->only('edit','update');
        $this->middleware('can:admin.role.delete')->only('destroy');
    }

    public function index()
    {
        $roles = Role::orderBy('id','ASC')->get();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('id','ASC')->get();

        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
            'description' => 'required|max:255'
        ]);
        
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.role.index')->with('success','Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('id','ASC')->get();

        return view('admin.role.edit',compact('role','permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        $role->update($request->all());
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.role.index')->with('success','Role updated successfully.');
    }

    public function destroy($id)
    {
        Role::where('id',decrypt($id))->delete();
        return redirect()->route('admin.role.index')->with('success','Role deleted successfully.');
    }
}
