<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Company::orderBy('id','DESC')->get();
        return view('admin.companies.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'cif'=>'required|max:9',
        ]);
        
        Company::create([
            'name'=>$request->name,
            'cif'=>$request->cif,
            'description'=>$request->description,
        ]);
        return redirect()->route('admin.company.index')->with('success','Company created successfully.');
    }

    public function edit($company)
    {
        $data = Company::where('id',decrypt($company))->first();
        return view('admin.companies.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'cif'=>'required|max:9',
        ]);

        Company::where('id', $request->id)->update([
            'name'=>$request->name,
            'cif'=>$request->cif,
            'description'=>$request->description,
        ]);
        return redirect()->route('admin.company.index')->with('info','Company updated successfully.');   
    }

    public function destroy($id)
    {
        Company::where('id',decrypt($id))->delete();
        return redirect()->route('admin.company.index')->with('error','Company deleted successfully.');   
    }
}
