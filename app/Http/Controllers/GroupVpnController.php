<?php

namespace App\Http\Controllers;

use App\Models\GroupVpn;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupVpnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $data = GroupVpn::orderBy('id', 'DESC')->get();
        view()->share('data', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.groups_vpn.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.groups_vpn.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'network' => 'required',
            'description' => 'required',
        ]);

        $group_vpn = new GroupVpn();
        $group_vpn->name = $request->name;
        $group_vpn->slug = $uniqueSlug;

        $group_vpn->save();

        return redirect()->route('admin.group_vpn.index')->with('success', 'GroupVpn created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = GroupVpn::where('id', decrypt($id))->first();
        return view('admin.groups_vpn.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'network' => 'required',
            'description' => 'required',
        ]);
        
        $group_vpn = GroupVpn::find($request->id);
        $group_vpn->name = $request->name;
        $group_vpn->slug = $uniqueSlug;
        
        $group_vpn->save();

        return redirect()->route('admin.group_vpn.index')->with('success', 'GroupVpn created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $group_vpn = GroupVpn::where('id', decrypt($id))->first();
       
        return redirect()->route('admin.group_vpn.index')->with('error', 'GroupVpn deleted successfully.');
    }
}
