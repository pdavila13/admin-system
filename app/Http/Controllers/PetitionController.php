<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\State;
use App\Models\Company;
use App\Models\Petition;
use App\Models\PetitionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PetitionController extends Controller
{
    public function __construct()
    {

        $this->middleware('can:admin.petition.index')->only('index');
        $this->middleware('can:admin.petition.create')->only('create','store');
        $this->middleware('can:admin.petition.edit')->only('edit','update');
        $this->middleware('can:admin.petition.delete')->only('destroy');
        
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
        $data = Petition::orderBy('datepicker', 'DESC')->get();

        // Crear una colección para almacenar archivos asociados a cada petición
        $petitionsWithFiles = $data->map(function ($petition) {
            $companyName = $petition->company->name;
            $folderPath = config('fs_share') . $companyName;
            $files = collect(Storage::allFiles($folderPath))->filter(function($file) use ($folderPath) {
                return strpos($file, $folderPath) === 0;
            });
            $petition->files = $files;
            return $petition;
        });

        return view('admin.petition.index', compact('data', 'petitionsWithFiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Auth::user();

        if (!$users) {
            return redirect()->route('login');
        }

        $currentDate = Carbon::now()->format('d-m-Y');

        return view('admin.petition.create', [
            'currentDate' => $currentDate,
            'users' => $users,
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
        $petition = Petition::findOrFail(decrypt($id));
        $companyName = $petition->company->name;
        $folderPath = config('fs_share') . $companyName;

        $files = collect(Storage::allFiles($folderPath))->filter(function($file) use ($folderPath) {
            return strpos($file, $folderPath) === 0;
        });

        return view('admin.petition.modal.show', compact('petition', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Petition::where('id', decrypt($id))->first();
        return view('admin.petition.modal.edit',compact('data'));
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

        return redirect()->route('admin.petition.index')->with('success', 'Petition updated successfully.');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Petition::where('id',decrypt($id))->delete();
        return redirect()->route('admin.petition.index')->with('success','Petition deleted successfully.');   
    }
}