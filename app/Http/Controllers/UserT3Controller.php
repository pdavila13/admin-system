<?php

namespace App\Http\Controllers;

use App\Models\UserT3;
use Illuminate\Http\Request;

class UserT3Controller extends Controller
{
    public function index()
    {
        $data = UserT3::orderBy('id','DESC')->get();
        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:'.UserT3::class,
            'password' => 'required|max:255|min:6',
            'role' => 'required'
        ]);

        $user = UserT3::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->route('admin.user.index')->with('success','UserT3 created successfully.');
    }

    public function edit($id)
    {
        $user = UserT3::where('id',decrypt($id))->first();
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request, UserT3 $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'string']
        ]); 
        $user = UserT3::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->assignRole($request->role);
        return redirect()->route('admin.user.index')->with('success','UserT3 updated successfully.');
    }

    public function destroy($id)
    {
        UserT3::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','UserT3 deleted successfully.');
    }
}