<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Petition;
use App\Models\PetitionType;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PetitionController extends Controller
{
    public function __construct()
    {
        $company = Company::orderBy('id','DESC')->get();
        view()->share('company',$company);

        $petitionType = PetitionType::orderBy('id','DESC')->get();
        view()->share('petitionType',$petitionType);

        $users = User::orderBy('id','DESC')->get();
        view()->share('users',$users);

        $state = State::orderBy('id','DESC')->get();
        view()->share('state',$state);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Petition::orderBy('datepicker','DESC')->get();
        return view('admin.petition.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $currentDate = Carbon::now()->format('d-m-Y');
        return view('admin.petition.create', [
            'currentDate' => $currentDate,
            'user' => $user,
            'company' => Company::orderBy('id', 'DESC')->get(),
            'petitionType' => PetitionType::orderBy('id', 'DESC')->get(),
            'state' => State::orderBy('id', 'DESC')->get(),
        ]);
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
            'datepicker'=>'required|date',
            'state_id'=>'required'
        ]);
        //$datepicker = Carbon::createFromFormat('Y-m-d', $request->datepicker);
        $datepicker = Carbon::createFromFormat('d-m-Y', $request->datepicker);

        Petition::create([
            'company_id'=>$request->company_id,
            'petition_type_id'=>$request->petition_type_id,
            'petition_number'=>$request->petition_number,
            'user_id'=>$request->user_id,
            'datepicker'=>$datepicker,
            'state_id'=>$request->state_id,
            'description'=>$request->description
        ]);

        return redirect()->route('admin.petition.index')->with('success','Petition created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Petition::where('id', decrypt($id))->first();
        return view('admin.petition.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Petition::where('id', decrypt($id))->first();
        return view('admin.petition.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'petition_number' => 'required|max:255',
            'company_id' => 'required',
            'petition_type_id' => 'required',
            'user_id' => 'required',
            'datepicker' => 'required|date',
            'state_id' => 'required'
        ]);

        $datepicker = Carbon::createFromFormat('d-m-Y', $request->datepicker);

        $petition = Petition::findOrFail($id);
        $petition->update([
            'company_id' => $request->company_id,
            'petition_type_id' => $request->petition_type_id,
            'petition_number' => $request->petition_number,
            'user_id' => $request->user_id,
            'datepicker' => $datepicker,
            'state_id' => $request->state_id,
            'description'=>$request->description
        ]);

        return redirect()->route('admin.petition.index')->with('info', 'Petition updated successfully.');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Petition::where('id',decrypt($id))->delete();
        return redirect()->route('admin.petition.index')->with('error','Petition deleted successfully.');   
    }
}