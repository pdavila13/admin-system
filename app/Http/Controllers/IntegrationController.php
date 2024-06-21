<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\DataService;
use App\Models\Inventory\Centro;
use App\Models\Inventory\Elemento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory\TipusAparell;

class IntegrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.integration.index')->only('index');
        $this->middleware('can:admin.integration.create')->only('create', 'store');
        $this->middleware('can:admin.integration.edit')->only('edit', 'update');
        $this->middleware('can:admin.integration.delete')->only('destroy');
    }
    
    /**
     * Display a listing of the resource.
     */
    private function getCommonData($integration = null)
    {
        $dataFromFacadeTypeOfDevice = DB::connection('inventory')->table('tipus_aparell')->orderBy('descripcio', 'ASC')->get();
        $dataFromFacadeModalities = DB::connection('inventory')->table('modalities')->orderBy('modality', 'ASC')->get();
        $dataFromFacadeTrademark = DB::connection('inventory')->table('marca')->where('tipo', '=', 9)->orderBy('DEF', 'ASC')->get();
        $dataFromFacadeModel = DB::connection('inventory')->table('modelo')->where('tipo', '=', 9)->orderBy('DEF', 'ASC')->get();
        $dataFromFacadeArea = DB::connection('inventory')->table('area')->whereNot('id', '=', 'STOCK')->orderBy('def', 'ASC')->get();
        $dataFromFacadeCenter = DB::connection('inventory')->table('centro')->orderBy('def', 'ASC')->get();
        $dataFromFacadeIntegrationState = DB::connection('inventory')->table('estat_integracio')->orderBy('descripcio', 'ASC')->get();

        $dataFromFacadeFloor = $integration 
            ? DB::connection('inventory')
                ->table('ubicacion')
                ->where('id_centro', $integration->centro)
                ->orderBy('planta')
                ->orderBy('edifici')
                ->get(['planta', 'edifici'])
                ->mapWithKeys(function($item) {
                    $key = $item->planta . $item->edifici;
                    return [$key => $key];
                })
            : DB::connection('inventory')
                ->table('ubicacion')
                ->orderBy('planta')
                ->orderBy('edifici')
                ->get(['planta', 'edifici'])
                ->mapWithKeys(function($item) {
                    $key = $item->planta . $item->edifici;
                    return [$key => $key];
                });

        return compact(
            'dataFromFacadeTypeOfDevice',
            'dataFromFacadeModalities',
            'dataFromFacadeTrademark',
            'dataFromFacadeModel',
            'dataFromFacadeArea',
            'dataFromFacadeCenter',
            'dataFromFacadeIntegrationState',
            'dataFromFacadeFloor'
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataFromFacadeElement = Elemento::select(
            'elemento.id',
            'elemento.centro',
            'centro.def as centro_def',
            'tipus_aparell.descripcio as tipus_aparell_def',
            'estat_integracio.idestat_integracio as estat_integracio_id',
            'elemento.def',
            'elemento.tipo',
            'elemento.marca',
            'elemento.modelo',
            'elemento.modality',
            'elemento.fecha'
        )
        ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
        ->leftJoin('tipus_aparell', 'elemento.tipus_aparell', '=', 'tipus_aparell.idtipus_aparell')
        ->leftJoin('estat_integracio', 'elemento.estat_integracio', '=', 'estat_integracio.idestat_integracio')
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
        $commonData = $this->getCommonData();
        $commonData['dataFromFacadeAreaFromElemento'] = (object) ['area_id' => null];

        return view('admin.integrations.create', $commonData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required',
            'def' => 'required',
            'tipus_aparell' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'centro' => 'required',
            'modality' => 'required',
            'sala' => 'required',
            'his' => 'required',
            'comentari' => 'required',
        ]);

        $user = Auth::user();

        Elemento::create([
            'tipo' => 9,
            'codigo' => $request['codigo'],
            'def' => $request['def'],
            'estado' => 1,
            'marca' => $request['marca'],
            'modelo' => $request['modelo'],
            'centro' => $request['centro'],
            'ubicacio' => $request['ubicacio'],
            'usuario' => $user->username,
            'fecha' => Carbon::now(),
            'perfil' => 56,
            'comentari' => $request['comentari'],
            'tipus_aparell' => $request['tipus_aparell'],
            'modality' => $request['modality'],
            // 'modality_data' => json_encode($request['modality_data']),
            'estat_integracio' => 3,
            'sala' => $request['sala'],
            'his' => $request['his'],
        ]);

        return redirect()->route('admin.integration.index')->with('success', 'Element created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Elemento $elemento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Elemento $integration)
    {
        Elemento::select(
            'elemento.id',
            'elemento.centro',
            'elemento.codigo',
            'centro.def as centro_def',
            'tipus_aparell.descripcio as tipus_aparell_def',
            'estat_integracio.idestat_integracio as estat_integracio_id',
            'elemento.def',
            'elemento.tipo',
            'elemento.marca',
            'elemento.modelo',
            'elemento.modality',
            'elemento.fecha',
            'elemento.his',
            'elemento.sala',
            'elemento.comentari'
        )
        ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
        ->leftJoin('tipus_aparell', 'elemento.tipus_aparell', '=', 'tipus_aparell.idtipus_aparell')
        ->leftJoin('estat_integracio', 'elemento.estat_integracio', '=', 'estat_integracio.idestat_integracio')
        ->where('elemento.tipo', '=', 9)
        ->where('elemento.estat_integracio', '=', 3)
        ->first();
    
        $commonData = $this->getCommonData($integration);
    
        $dataFromFacadeAreaFromElemento = DB::connection('inventory')
            ->table('elemento')
            ->select('area.id as area_id', 'area.def as area_def')
            ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
            ->leftJoin('zona', 'centro.zona', '=', 'zona.id')
            ->leftJoin('area', 'zona.area', '=', 'area.id')
            ->where('elemento.id', $integration->id)
            ->first();
    
        $commonData['dataFromFacadeAreaFromElemento'] = $dataFromFacadeAreaFromElemento;
    
        $dataFromFacadeIP = Elemento::on('inventory')
            ->with(['ip', 'centro'])
            ->leftJoin('ip', 'elemento.id', '=', 'ip.id')
            ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
            ->select(
                'elemento.id',
                DB::raw("concat(ip.ip1,'.',ip.ip2,'.',ip.ip3,'.',ip.ip4) as ip"),
                DB::raw("concat(centro.ip1,'.',centro.ip2,'.',centro.ip3,'.',centro.ip4) as centro_ip"),
                DB::raw("concat(centro.mask1,'.',centro.mask2,'.',centro.mask3,'.',centro.mask4) as centro_mask")
            )
            ->get();
    
        $commonData['dataFromFacadeIP'] = $dataFromFacadeIP;
    
        return view('admin.integrations.edit', array_merge($commonData, compact('integration')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Elemento $elemento)
    {
        // $dataFromFacadeElement = DB::connection('inventory')->table('elemento')->findOrFail($id);
        return redirect()->route('admin.integration.index')->with('success', 'Element updated successfully.');
    }

    public function calculateGateway($ip, $mask)
    {
        // Validar y separar las partes de la IP
        $ipParts = explode('.', $ip);
        if (count($ipParts) !== 4) {
            throw new \Exception('IP address is not valid.');
        }
    
        // Validar y separar las partes de la máscara
        $maskParts = explode('.', $mask);
        if (count($maskParts) !== 4) {
            throw new \Exception('Subnet mask is not valid.');
        }
    
        $networkParts = [];
        for ($i = 0; $i < 4; $i++) {
            $networkParts[] = intval($ipParts[$i]) & intval($maskParts[$i]);
        }
    
        // Incrementar la última parte para obtener el gateway
        $networkParts[3] += 1;
    
        // Combinar las partes de nuevo en una cadena de IP
        $gateway = implode('.', $networkParts);
    
        return $gateway;
    }
}
