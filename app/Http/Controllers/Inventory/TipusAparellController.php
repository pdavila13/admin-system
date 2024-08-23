<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory\TipusAparell;
use Illuminate\Http\Request;

class TipusAparellController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.tipus_aparell.index')->only('index','store','update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TipusAparell::get();
        return view('admin.inventory.tipus_aparell', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcio'=>'required|max:255',
        ]);
        
        TipusAparell::create([
            'descripcio'=>$request->descripcio,
        ]);
        
        return redirect()->route('admin.tipus_aparell.index')->with('success','Equipment type created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcio'=>'required|max:255',
        ]);

        TipusAparell::where('idtipus_aparell', $id)->update([
            'descripcio'=>$request->descripcio,
        ]);
        return redirect()->route('admin.tipus_aparell.index')->with('info','Equipment type updated successfully.');   
    }
}
