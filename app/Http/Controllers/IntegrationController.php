<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use function Ramsey\Uuid\v1;

use Illuminate\Http\Request;
use App\Models\Inventory\Elemento;
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
        
        $dataFromFacadeModel = DB::connection('inventory')->table('modelo')->where('tipo','=',9)->orderBy('DEF','ASC')->get();
        view()->share('dataFromFacadeModel',$dataFromFacadeModel);

        $dataFromFacadeArea = DB::connection('inventory')->table('area')->whereNot('id', '=', 'STOCK')->orderBy('def','ASC')->get();
        view()->share('dataFromFacadeArea',$dataFromFacadeArea);

        $dataFromFacadeCenter = DB::connection('inventory')->table('centro')->orderBy('def','ASC')->get();
        view()->share('dataFromFacadeCenter',$dataFromFacadeCenter);

        $dataFromFacadeIP = Elemento::on('inventory')
            ->with(['tipo','marca','modelo','ip','centro'])
            ->leftJoin('tipo', 'elemento.tipo', '=', 'tipo.id')
            ->leftJoin('marca', 'elemento.marca', '=', 'marca.ID')
            ->leftJoin('modelo', 'elemento.modelo', '=', 'modelo.id')
            ->leftJoin('ip', 'elemento.id', '=', 'ip.id')
            ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
            ->select(
                'elemento.id',
                'tipo.def as tipo_def',
                'elemento.def',
                'marca.DEF as marca_def',
                'modelo.def as modelo_def',
                DB::raw("concat(ip.ip1,'.',ip.ip2,'.',ip.ip3,'.',ip.ip4) as ip"),
                DB::raw("concat(centro.ip1,'.',centro.ip2,'.',centro.ip3,'.',centro.ip4) as centro_ip"),
                DB::raw("concat(centro.mask1,'.',centro.mask2,'.',centro.mask3,'.',centro.mask4) as centro_mask")
            )
            ->where('elemento.tipo', '=', 9)
            ->get();

        view()->share('dataFromFacadeIP', $dataFromFacadeIP);
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
        ->where('elemento.estat_integracio', '=', 3)
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
    public function edit(Integration $integration)
    {
        $elemento = Elemento::find($integration);

        // // Obtener el elemento a editar
        // $dataFromFacadeElement = DB::connection('inventory')->table('elemento')->where('id', $elemento)->first();

        // // Verificar si el elemento existe
        // if (!$dataFromFacadeElement) {
        //     return redirect()->route('admin.integrations.index')->with('error', 'Element not found.');
        // }

        // // Obtener los tipos de dispositivos
        // $dataFromFacadeTypeOfDevice = DB::connection('inventory')->table('tipus_aparell')->get();

        // Retornar la vista con los datos del elemento y los tipos de dispositivos
        return view('admin.integrations.edit', compact('integration', 'elemento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Integration $integration)
    {
        // $dataFromFacadeElement = DB::connection('inventory')->table('elemento')->findOrFail($id);
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
