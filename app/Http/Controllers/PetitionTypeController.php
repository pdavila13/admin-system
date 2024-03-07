<?php

namespace App\Http\Controllers;

use App\Models\PetitionType;
use Illuminate\Http\Request;

class PetitionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PetitionType::orderBy('id','DESC')->get();
        return view('admin.petition_type.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.petition_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
        ]);

        PetitionType::create([
            'name'=>$request->name,
        ]);
        return redirect()->route('admin.petition_type.index')->with('success','Petition type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PetitionType $petitionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PetitionType $petitionType)
    {
        $data = PetitionType::where('id',decrypt($petitionType))->first();
        return view('admin.petition_type.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PetitionType $petitionType)
    {
        $request->validate([
            'name'=>'required|max:255',
        ]);
        
        PetitionType::where('id', $request->id)->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.petition_type.index')->with('info','Petition type updated successfully.');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PetitionType $petitionType)
    {
        PetitionType::where('id',decrypt($id))->delete();
        return redirect()->route('admin.petition_type.index')->with('error','Petition type deleted successfully.');
    }
}
