<?php

namespace App\Http\Controllers;

use App\Models\GroupVpn;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupVpnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('can:admin.group_vpn.index')->only('index');
        $this->middleware('can:admin.group_vpn.create')->only('create','store');
        $this->middleware('can:admin.group_vpn.edit')->only('edit','update');
        $this->middleware('can:admin.group_vpn.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GroupVpn::whereHas('company', function ($query) {
            $query->where('active', 1);
        })->orderBy('id', 'DESC')->get();
        
        return view('admin.groups_vpn.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::orderBy('id','DESC')->get();
        return view('admin.groups_vpn.modal.create', compact('company'));
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
            'company_id' => 'required'
        ]);

        GroupVpn::create([
            'name'=>$request->name,
            'network'=>$request->network,
            'description'=>$request->description,
            'company_id'=>$request->company_id
        ]);

        return redirect()->route('admin.group_vpn.index')->with('success', 'GroupVpn created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = GroupVpn::where('id', decrypt($id))->first();
        $company = Company::orderBy('id','DESC')->get();
        return view('admin.groups_vpn.modal.edit', compact('data', 'company'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'network' => 'required',
            'description' => 'required',
            'company_id' => 'required'
        ]);

        $group_vpn = GroupVpn::findOrFail($id);
        $group_vpn->name = $request->name;
        $group_vpn->network = $request->network;
        $group_vpn->description = $request->description;
        $group_vpn->company_id = $request->company_id;
        
        $group_vpn->save();

        return redirect()->route('admin.group_vpn.index')->with('success', 'GroupVpn updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $group_vpn = GroupVpn::findOrFail(decrypt($id));
        $group_vpn->delete();

        return redirect()->route('admin.group_vpn.index')->with('success', 'GroupVpn deleted successfully.');
    }
}