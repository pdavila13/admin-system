<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$dataFromFacade = DB::connection('inventory')->table('elemento')->where('perfil', '=', 56)->get();

        $dataFromFacade = DB::connection('inventory')
        ->table('elemento')
        ->leftJoin('tipo', 'elemento.tipo', '=', 'tipo.id')
        ->leftJoin('marca', 'elemento.marca', '=', 'marca.id')
        ->leftJoin('modelo', 'elemento.modelo', '=', 'modelo.id')
        ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
        ->leftJoin('estat_integracio', 'elemento.estat_integracio', '=', 'estat_integracio.idestat_integracio')
        ->select(
            'elemento.id',
            'tipo.def as tipo_def',
            'elemento.codigo',
            'elemento.def',
            'marca.def as marca_def',
            'modelo.def as modelo_def',
            'centro.def as centro_def',
            'elemento.aet',
            'elemento.modality',
            'elemento.maquina_sap',
            'estat_integracio.descripcio as estat_integracio_descripcio'
        )
        //->where('elemento.perfil', '=', 56)
        ->where('elemento.tipo', '=', 9)
        ->get();

        return view('admin.inventory.index', ['dataFromFacade' => $dataFromFacade]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
