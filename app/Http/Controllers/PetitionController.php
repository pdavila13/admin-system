<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Petition::orderBy('id','DESC')->get();
        return view('admin.petition.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.petition.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'petition_number'=>'required|max:255',
        ]);
        
        Petition::create([
            'petition_number'=>$request->petition_number,
        ]);
        return redirect()->route('admin.petition.index')->with('success','Petition created successfully.');
    }

    public function edit($petition)
    {
        $data = Petition::where('id',decrypt($petition))->first();
        return view('admin.petition.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'petition_number'=>'required|max:255',
        ]);

        Petition::where('id', $request->id)->update([
            'petition_number'=>$request->petition_number,
        ]);
        return redirect()->route('admin.petition.index')->with('info','Petition updated successfully.');   
    }

    public function destroy($id)
    {
        Petition::where('id',decrypt($id))->delete();
        return redirect()->route('admin.petition.index')->with('error','Petition deleted successfully.');   
    }
}