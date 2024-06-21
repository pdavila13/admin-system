<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
        $data = Role::orderBy('id','ASC')->get();
        return view('admin.role.index', compact('data'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);
        Role::updateOrCreate(
            [
                'id'=>$request->id
            ],[
                'name'=>$request->name,
            ]
        );
        if($request->id){
            $msg = 'Role updated successfully.';
        }else{
            $msg = 'Role created successfully.';
        }
        return redirect()->route('admin.role.index')->with('success',$msg);
    }

    public function edit($id)
    {
        $data = Role::where('id',decrypt($id))->first();
        return view('admin.role.edit',compact('data'));
    }

    public function destroy($id)
    {
        Role::where('id',decrypt($id))->delete();
        return redirect()->route('admin.role.index')->with('error','Role deleted successfully.');
    }
}
