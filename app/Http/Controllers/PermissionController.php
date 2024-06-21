<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.permission.index')->only('index');
        $this->middleware('can:admin.permission.create')->only('create','store');
        $this->middleware('can:admin.permission.edit')->only('edit','update');
        $this->middleware('can:admin.permission.delete')->only('destroy');
    }
    
    public function index()
    {
        $data = Permission::orderBy('id','ASC')->get();
        return view('admin.permission.index',compact('data'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);
        Permission::updateOrCreate(
            [
                'id'=>$request->id
            ],[
                'name'=>$request->name,
            ]
        );
        if($request->id){
            $msg = 'Permission updated successfully.';
        }else{
            $msg = 'Permission created successfully.';
        }
        return redirect()->route('admin.permission.index')->with('success',$msg);
    }

    public function edit($id)
    {
        $data = Permission::where('id',decrypt($id))->first();
        return view('admin.permission.edit',compact('data'));
    }

    public function destroy($id)
    {
        Permission::where('id',decrypt($id))->delete();
        return redirect()->route('admin.permission.index')->with('error','Permission deleted successfully.');
    }
}
