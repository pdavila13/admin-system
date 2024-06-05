<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

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

        $dataFromFacadeArea = DB::connection('inventory')->table('area')->whereNot('id', '=', 'STOCK')->orderBy('def','ASC')->get();
        view()->share('dataFromFacadeArea',$dataFromFacadeArea);

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
        ->where('elemento.estat_integracio', '>', 1)
        ->get();
        view()->share('dataFromFacadeElement',$dataFromFacadeElement);
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
        ->where('elemento.estat_integracio', '>', 1)
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
    public function edit($id)
    {
        // Obtener el elemento a editar
        $dataFromFacadeElement = DB::connection('inventory')->table('elemento')->where('id', $id)->first();

        // Verificar si el elemento existe
        if (!$dataFromFacadeElement) {
            return redirect()->route('admin.integrations.index')->with('error', 'Element not found.');
        }

        // Obtener los tipos de dispositivos
        $dataFromFacadeTypeOfDevice = DB::connection('inventory')->table('tipus_aparell')->get();

        // Retornar la vista con los datos del elemento y los tipos de dispositivos
        return view('admin.integrations.modal.edit', compact('dataFromFacadeElement', 'dataFromFacadeTypeOfDevice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dataFromFacadeElement = DB::connection('inventory')->table('elemento')->findOrFail($id);
        return redirect()->route('admin.integrations.index')->with('success', 'Element updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
