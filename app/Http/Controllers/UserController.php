<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.user.index')->only('index');
        $this->middleware('can:admin.user.create')->only('create','store');
        $this->middleware('can:admin.user.edit')->only('edit','update');
        $this->middleware('can:admin.user.delete')->only('destroy');
    }

    public function index()
    {
        $data = User::orderBy('id','ASC')->get();
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
            'email' => 'required', 'string', 'email', 'max:255', 'unique:'.User::class,
            'password' => 'required|max:255|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole($request->role);
        return redirect()->route('admin.user.index')->with('success','User created successfully.');
    }

    public function edit(User $user)
    {
        //$user = User::where('id',decrypt($user))->first();
        $roles = Role::all();

        return view('admin.user.edit',compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', 'array']
        ]); 

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $roles = Role::whereIn('id', $request->role)->pluck('name')->toArray();

        $user->syncRoles($roles);

        return redirect()->route('admin.user.index')->with('success','User updated successfully.');
    }

    public function destroy($id)
    {
        User::where('id',decrypt($id))->delete();
        return redirect()->back()->with('success','User deleted successfully.');
    }
}
