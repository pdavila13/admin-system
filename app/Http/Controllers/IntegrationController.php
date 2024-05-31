<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IntegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $dataFromFacadeTypeOfDevice = DB::connection('inventory')->table('tipus_aparell')->orderBy('descripcio','ASC')->get();
        view()->share('dataFromFacadeTypeOfDevice',$dataFromFacadeTypeOfDevice);

        $dataFromFacadeModalities = DB::connection('inventory')->table('modalities')->orderBy('modality','ASC')->get();
        view()->share('dataFromFacadeModalities',$dataFromFacadeModalities);

        $dataFromFacadeTrademark = DB::connection('inventory')->table('marca')->where('tipo','=',9)->orderBy('DEF','ASC')->get();
        view()->share('dataFromFacadeTrademark',$dataFromFacadeTrademark);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataFromFacadeElement = DB::connection('inventory')
        ->table('elemento')
        ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
        ->leftJoin('tipus_aparell', 'elemento.tipus_aparell', '=', 'tipus_aparell.idtipus_aparell')
        ->leftJoin('estat_integracio', 'elemento.estat_integracio', '=', 'estat_integracio.idestat_integracio')
        ->select(
            'elemento.id',
            'centro.def as centro_def',
            'tipus_aparell.descripcio as tipus_aparell_descripcio',
            'elemento.def',
            'elemento.codigo',
            'elemento.ubicacio',
            'elemento.fecha',
            'elemento.aet',
            'elemento.modality',
            'elemento.maquina_sap',
            'elemento.ut',
            'estat_integracio.descripcio as estat_integracio_descripcio'
        )
        ->where('elemento.tipo', '=', 9)
        ->where('elemento.estat_integracio', '>', 0)
        ->get();

        return view('admin.integrations.index', compact('dataFromFacadeElement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$dataFromFacadeTypeOfDevice = DB::connection('inventory')->table('tipus_aparell')->get();
        //return view('admin.integrations.modal.create', compact('dataFromFacadeTypeOfDevice'));
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
