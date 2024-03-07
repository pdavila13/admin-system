<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Petition;
use App\Models\State;
use App\Models\PetitionType;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    public function __construct()
    {
        $company = Company::orderBy('id','DESC')->get();
        view()->share('company',$company);

        $petitionType = PetitionType::orderBy('id','DESC')->get();
        view()->share('petitionType',$petitionType);

        $user = User::orderBy('id','DESC')->get();
        view()->share('user',$user);

        $state = State::orderBy('id','DESC')->get();
        view()->share('state',$state);
    }
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
            'company_id'=>'required',
            'petition_type_id'=>'required',
            'user_id'=>'required',
            //'created_at'=>'required',
            'state_id'=>'required'
        ]);

        Petition::create([
            'company_id'=>$request->company_id,
            'petition_type_id'=>$request->petition_type_id,
            'petition_number'=>$request->petition_number,
            'user_id'=>$request->user_id,
            //'created_at'=>$request->created_at,
            'state_id'=>$request->state_id
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