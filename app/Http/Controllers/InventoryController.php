<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory\Elemento;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataFromFacade = Elemento::on('inventory')
        ->with(['tipo','marca','modelo','centro','estat_integracio'])
        ->leftJoin('tipo', 'elemento.tipo', '=', 'tipo.id')
        ->leftJoin('marca', 'elemento.marca', '=', 'marca.ID')
        ->leftJoin('modelo', 'elemento.modelo', '=', 'modelo.id')
        ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
        ->leftJoin('estat_integracio', 'elemento.estat_integracio', '=', 'estat_integracio.idestat_integracio')
        ->select(
            'elemento.id',
            'tipo.def as tipo_def',
            'elemento.codigo',
            'elemento.def',
            'marca.DEF as marca_def',
            'modelo.def as modelo_def',
            'centro.def as centro_def',
            'elemento.aet',
            'elemento.modality',
            'estat_integracio.descripcio as estat_integracio_descripcio'
        )
        ->where('elemento.tipo', '=', 9)
        ->get();

        return view('admin.inventory.index', ['dataFromFacade' => $dataFromFacade]);
    }

    public function getModels($trademark)
    {
        $models = DB::connection('inventory')
                    ->table('modelo')
                    ->where('marca', $trademark)
                    ->orderBy('def', 'ASC')
                    ->get();

        return response()->json($models);
    }

    public function getCenters($zona)
    {
        $query = DB::connection('inventory')
            ->table('centro')
            ->join('zona', 'centro.zona', '=', 'zona.id')
            ->select('centro.*')
            ->where('centro.visible', '=', 1)
            ->orderBy('centro.def', 'ASC');

        // Check the zona and apply additional conditions based on the area
        if ($zona === 'HOSPI') {
            $query->where(function ($query) {
                $query->where('centro.zona', 'VLANS')
                    ->where('centro.id', 'VlanRadiologia')
                    ->orWhere(function ($query) {
                        $query->where('centro.zona', 'GIPSS')
                                ->where('centro.id', 'gipss_francoli');
                    });
            });
        } else {
            $query->where('zona.area', $zona);
        }

        $centers = $query->get();

        return response()->json($centers);
    }


    public function getPlantas($centroId)
    {
        $plantas = DB::connection('inventory')
            ->table('ubicacion')
            ->where('id_centro', $centroId)
            ->orderBy('planta')
            ->orderBy('edifici')
            ->get(['planta', 'edifici']);

        return response()->json($plantas);
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
