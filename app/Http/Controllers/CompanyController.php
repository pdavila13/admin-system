<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Company::where('active', 1)->orderBy('id', 'DESC')->get();
        return view('admin.companies.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.modal.create');
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

        $companyName = $request->name;
        $companyDirectory = env('FILESYSTEM_SHARE') . $companyName;

        if (Storage::exists($companyDirectory)) {
            return back()->withInput()->with('error', 'The company directory already exists.');
        }
        
        Company::create([
            'name'=>$request->name,
            'cif'=>$request->cif,
            'description'=>$request->description,
            'active'=>1,
        ]);

        Storage::makeDirectory($companyDirectory);
        
        return redirect()->route('admin.company.index')->with('success','Company created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($company)
    {
        $id = decrypt($company);
        $data = Company::findOrFail($id);
        return view('admin.companies.modal.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:255',
            'cif'=>'required|max:9',
        ]);
        Company::where('id', $id)->update([
            'name'=>$request->name,
            'cif'=>$request->cif,
            'description'=>$request->description,
            'active'=>1,
        ]);
        return redirect()->route('admin.company.index')->with('info','Company updated successfully.');   
    }

    /**
     * Desactive the specified resource from storage.
     */
    public function destroy($id)
    {
        $companyId = decrypt($id);
    
        $company = Company::findOrFail($companyId);

        $company->active = 0;
        $company->save();

        return redirect()->route('admin.company.index')->with('success', 'Company deactivated successfully.');
    }
}