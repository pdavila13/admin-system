<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers\IPHelper;
use Illuminate\Http\Request;
use App\Models\Inventory\Elemento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            'tipo.def as tipo_def',
            'marca.DEF as marca_def',
            'modelo.def as modelo_def',
            'tipus_aparell.descripcio as tipus_aparell_def',
            'estat_integracio.idestat_integracio as estat_integracio_id',
            'descripcio_perfil as perfil_def',
            'elemento.def',
            'elemento.tipo',
            'elemento.marca',
            'elemento.modelo',
            'elemento.codigo',
            'elemento.modality',
            'elemento.aet',
            'elemento.maquina_sap',
            'elemento.ut',
            'elemento.codi_evolutiu',
            'elemento.roseta',
            'elemento.switch',
            'elemento.fecha',
            DB::raw("concat(ip.ip1,'.',ip.ip2,'.',ip.ip3,'.',ip.ip4) as ip")
        )
        ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
        ->leftJoin('tipo', 'elemento.tipo', '=', 'tipo.id')
        ->leftJoin('marca', 'elemento.marca', '=', 'marca.id')
        ->leftJoin('modelo', 'elemento.modelo', '=', 'modelo.id')
        ->leftJoin('tipus_aparell', 'elemento.tipus_aparell', '=', 'tipus_aparell.idtipus_aparell')
        ->leftJoin('estat_integracio', 'elemento.estat_integracio', '=', 'estat_integracio.idestat_integracio')
        ->leftJoin('ip', 'elemento.id', '=', 'ip.id')
        ->leftJoin('perfils', 'elemento.perfil', '=', 'perfils.id_perfil')
        ->where('elemento.tipo', '=', 9)
        ->where('elemento.estat_integracio', '>=', 1)
        ->where('elemento.estado', '=', 1)
        ->orderBy('elemento.fecha', 'DESC')
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
     * Auxiliar function to handle SAP data insertions
     */
    private function insertSAPData($user, $integration)
    {
        // Generate the edit URL for the integration
        $editUrl = route('admin.integration.edit', $integration);

        $solId = DB::connection('portalaplicacions')->table('SOL_D_ACTIVITAT')->insertGetId([
            'SOL_NIVELL' => 10,
            'SOL_DATA_ALTA' => Carbon::now(),
            'SOL_ESTAT' => 1,
            'SOL_NIF' => $user->username,
            'SOL_SOLICITANT' => $user->name,
            'SOL_TELEFON' => $user->phone,
            'SOL_DESCRIPCIO' => __('messages.sap_description') . $editUrl,
            'SOL_ID_CENTRE' => 'suport',
            'SOL_MAIL' => $user->email,
            'SOL_TIPOLOGIA' => 2,
        ]);

        DB::connection('portalaplicacions')->table('SOL_D_NOTES_TECNICS')->insert([
            'NOT_ID_REGISTRE' => $solId,
            'NOT_ID_TECNIC' => $user->username,
            'NOT_DATA' => Carbon::now(),
            'NOT_NOTA' => 'ALTA',
            'NOT_ES_PUBLICABLE' => 1,
        ]);

        DB::connection('portalaplicacions')->table('SOL_D_ASSIG_TECNICS')->insert([
            'ASSIG_ID_REGISTRE' => $solId,
            'ASSIG_ID_TECNIC' => 'X0000007F',
            'ASSIG_DATA_INICI' => Carbon::now(),
            'ASSIG_NIF' => $user->username,
            'ASSIG_MODIFICAT' => Carbon::now(),
        ]);
    }

    /**
     * Auxiliar function to handle ECAP data insertions
     */
    private function insertECAPData($user, $integration)
    {
        // Generate the edit URL for the integration
        $editUrl = route('admin.integration.edit', $integration);

        $solId = DB::connection('portalaplicacions')->table('SOL_D_ACTIVITAT')->insertGetId([
            'SOL_NIVELL' => 6,
            'SOL_DATA_ALTA' => Carbon::now(),
            'SOL_ESTAT' => 1,
            'SOL_NIF' => $user->username,
            'SOL_SOLICITANT' => $user->name,
            'SOL_DESCRIPCIO' => __('messages.ecap_description') . $editUrl,
            'SOL_ID_CENTRE' => 'suport',
            'SOL_MAIL' => $user->email,
            'SOL_TIPOLOGIA' => 2,
        ]);

        DB::connection('portalaplicacions')->table('SOL_D_NOTES_TECNICS')->insert([
            'NOT_ID_REGISTRE' => $solId,
            'NOT_ID_TECNIC' => $user->username,
            'NOT_DATA' => Carbon::now(),
            'NOT_NOTA' => 'ALTA',
            'NOT_ES_PUBLICABLE' => 1,
        ]);

        DB::connection('portalaplicacions')->table('SOL_D_NOTES_TECNICS')->insert([
            'ASSIG_ID_REGISTRE' => $solId,
            'ASSIG_ID_TECNIC' => 'X0000001R',
            'ASSIG_DATA_INICI' => Carbon::now(),
            'ASSIG_NIF' => $user->username,
            'ASSIG_MODIFICAT' => Carbon::now(),
        ]);
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
            'his' => 'required',
            'comentari' => 'required',
        ]);

        $user = Auth::user();

        // Start the transaction to ensure data consistency in the database
        DB::beginTransaction();

        try {
            $integration = Elemento::create([
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
                'estat_integracio' => 1,
                'sala' => $request['sala'],
                'his' => $request['his'],
            ]);

            if ($request['his'] === 'SAP') {
                $this->insertSAPData($user, $integration);
            } elseif ($request['his'] === 'ECAP') {
                $this->insertECAPData($user, $integration);
            }

            // Confirm the transaction
            DB::commit();
            return redirect()->route('admin.integration.index')->with('success', __('messages.element_created'));
        } catch (\Exception $e) {
            // In case of error, rollback the transaction
            DB::rollBack();
            return redirect()->route('admin.integration.index')->with('error', __('messages.error_creating_element'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Elemento $elemento)
    {
        return view('admin.integrations.modal.show', compact('elemento'));
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
            'elemento.aet',
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
        ->where('estat_integracio.idestat_integracio', '>=', 1)
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
    
        $dataFromFacadeIP = DB::connection('inventory')->table('elemento')
            ->leftJoin('ip', 'elemento.id', '=', 'ip.id')
            ->leftJoin('centro', 'elemento.centro', '=', 'centro.id')
            ->select(
                'elemento.id',
                'elemento.centro',
                DB::raw("concat(ip.ip1,'.',ip.ip2,'.',ip.ip3,'.',ip.ip4) as ip"),
                DB::raw("concat(centro.ip1,'.',centro.ip2,'.',centro.ip3,'.',centro.ip4) as centro_ip"),
                DB::raw("concat(centro.mask1,'.',centro.mask2,'.',centro.mask3,'.',centro.mask4) as centro_mask")
            )
            ->where('elemento.id', $integration->id)
            ->first();

        $networkIp = $dataFromFacadeIP->centro_ip;  // Ejemplo: "10.84.139.0"
        $mask = $dataFromFacadeIP->centro_mask;       // Ejemplo: "255.255.254.0"

        // Obtener las IPs usadas (por ejemplo, extraídas de la tabla 'ip')
        $usedIPs = /* array de IPs ya asignadas, e.g.: */ ['10.84.139.5', '10.84.139.6'];

        // Obtener IPs disponibles:
        $ipsLibres = IPHelper::getAvailableIPs($networkIp, $mask, $usedIPs);

        // Si se encontró la configuración de red, procesamos las IPs usadas y calculamos las libres.
        if ($dataFromFacadeIP) {
            // La IP de la red (ya concatenada) y la máscara se usan como parámetros para el helper.
            $networkIp = $dataFromFacadeIP->centro_ip; // Ejemplo: "10.84.139.32"
            $mask = $dataFromFacadeIP->centro_mask;      // Ejemplo: "255.255.254.0"

            // Convertir la IP de la red en partes para usar en la condición del query.
            $parts = explode('.', $networkIp);

            // Recuperar las IPs ya asignadas (usadas) para el centro.
            // La condición depende de la máscara: 
            if ($mask === '255.255.254.0') {
                // Rango más amplio: filtrar por ip1 e ip2.
                $usedIPs = DB::connection('inventory')->table('ip')
                    ->selectRaw("concat(ip1,'.',ip2,'.',ip3,'.',ip4) as ip")
                    ->where('ip1', $parts[0])
                    ->where('ip2', $parts[1])
                    ->orderBy('ip3')
                    ->orderBy('ip4')
                    ->pluck('ip')
                    ->toArray();
            } else {
                // Rango más restringido: filtrar por ip1, ip2 e ip3.
                $usedIPs = DB::connection('inventory')->table('ip')
                    ->selectRaw("concat(ip1,'.',ip2,'.',ip3,'.',ip4) as ip")
                    ->where('ip1', $parts[0])
                    ->where('ip2', $parts[1])
                    ->where('ip3', $parts[2])
                    ->orderBy('ip4')
                    ->pluck('ip')
                    ->toArray();
            }

            // Llamamos al helper para obtener las IPs libres en la red, excluyendo las usadas.
            $ipsLibres = IPHelper::getAvailableIPs($networkIp, $mask, $usedIPs);
        } else {
            $ipsLibres = [];
        }


        // Supongamos que ya has calculado $ipsLibres usando tu helper (array de strings, ej: ['10.84.139.5', '10.84.139.6', ...])
        // Ahora, preparamos las opciones para el select:
        if (!empty($dataFromFacadeIP->ip)) {
            // Si el elemento tiene una IP asignada, mostramos esa IP como única opción.
            // Puedes usar el ID de la IP o simplemente usar la IP como clave y valor.
            $ipOptions = [$dataFromFacadeIP->id => $dataFromFacadeIP->ip];
        } else {
            // Si no tiene IP asignada, mostramos la lista de IPs libres.
            // Por ejemplo, creando un array en que la clave y el valor sean la propia IP:
            $ipOptions = array_combine($ipsLibres, $ipsLibres);
        }

        // El resto del código de tu método edit (gateway, commonData, etc.)
        if ($dataFromFacadeIP) {
            try {
                $gateway = $this->calculateGateway($dataFromFacadeIP->centro_ip, $dataFromFacadeIP->centro_mask);
            } catch (\Exception $e) {
                $gateway = 'N/A';
            }
        } else {
            $gateway = 'N/A';
        }

        // Construir el array de opciones para el select de IPs
        if (!empty($dataFromFacadeIP->ip)) {
            // El elemento tiene una IP asignada.
            // Primero, creamos un array con las IPs libres (clave y valor iguales)
            $ipOptions = array_combine($ipsLibres, $ipsLibres);
            
            // Asegurarnos de que la IP asignada aparezca en el array.
            // Si no se encuentra, la agregamos al principio.
            if (!isset($ipOptions[$dataFromFacadeIP->ip])) {
                $ipOptions = [$dataFromFacadeIP->ip => $dataFromFacadeIP->ip] + $ipOptions;
            } else {
                // Si ya está, la movemos al principio.
                $temp = [$dataFromFacadeIP->ip => $dataFromFacadeIP->ip];
                foreach ($ipOptions as $key => $val) {
                    if ($key !== $dataFromFacadeIP->ip) {
                        $temp[$key] = $val;
                    }
                }
                $ipOptions = $temp;
            }
        } else {
            // Si no tiene una IP asignada, usamos únicamente las IPs libres.
            $ipOptions = array_combine($ipsLibres, $ipsLibres);
        }

        // Si no hay IP asignada, opcionalmente podemos dejar un placeholder para que el usuario seleccione:
        $selectAttributes = ['class' => 'form-control select2 select2-bootstrap4'];
        if (empty($dataFromFacadeIP->ip)) {
            $selectAttributes['placeholder'] = 'Selecciona una ip';
        }

        return view('admin.integrations.edit', array_merge(
            $commonData,
            compact('integration', 'gateway', 'dataFromFacadeIP', 'ipsLibres')
        ))->with('ipOptions', $ipOptions)
          ->with('selectAttributes', $selectAttributes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Elemento $integration)
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();

        $fieldsAllowed = [
            'Admin' => [
                'codigo', 'def', 'tipus_aparell', 'marca', 'modelo', 'centro', 
                'ubicacio', 'aet', 'modality', 'his', 'comentari', 
                'maquina_sap', 'maquina_sap_desc', 'servei', 'ut',
                'ip_address','roseta', 'switch', 'codi_evolutiu', 'estat_integracio'
            ],
            'User SAP' => [
                'maquina_sap', 'maquina_sap_desc', 'servei', 'ut', 'estat_integracio'
            ],
            'User GEE' => [
                'codigo', 'def', 'tipus_aparell', 'marca', 'modelo', 'centro', 
                'ubicacio', 'modality', 'his', 'comentari', 'estat_integracio'
            ],
        ];

        // Obtener los campos permitidos para el rol del usuario actual
        $allowedFields = $fieldsAllowed[$role] ?? [];

        // Filtrar los datos del request para incluir solo los campos permitidos
        $data = $request->only($allowedFields);

        // Definir las reglas de validación para los campos permitidos
        $rules = [];
        if (in_array('codigo', $allowedFields)) {
            $rules['codigo'] = 'required';
        }
        if (in_array('def', $allowedFields)) {
            $rules['def'] = 'required';
        }
        if (in_array('tipus_aparell', $allowedFields)) {
            $rules['tipus_aparell'] = 'required';
        }
        if (in_array('marca', $allowedFields)) {
            $rules['marca'] = 'required';
        }
        if (in_array('modelo', $allowedFields)) {
            $rules['modelo'] = 'required';
        }
        if (in_array('centro', $allowedFields)) {
            $rules['centro'] = 'required';
        }
        if (in_array('aet', $allowedFields)) {
            $rules['aet'] = 'required';
        }
        if (in_array('modality', $allowedFields)) {
            $rules['modality'] = 'required';
        }
        if (in_array('estat_integracio', $allowedFields)) {
            $rules['estat_integracio'] = 'required';
        }
        if (in_array('his', $allowedFields)) {
            $rules['his'] = 'required';
        }
        if (in_array('comentari', $allowedFields)) {
            $rules['comentari'] = 'required';
        }
        if (in_array('ip_address', $allowedFields)) {
            $rules['ip_address'] = 'required';
        }
        // Si se ha seleccionado una IP en el formulario, la guardamos en la tabla 'ip'
        if ($request->has('ip_address')) {
            $selectedIp = $request->input('ip_address'); // Por ejemplo, "10.84.139.5"
            $parts = explode('.', $selectedIp);
            if (count($parts) === 4) {
                // Actualiza o inserta el registro en la tabla 'ip' usando el id del elemento
                DB::connection('inventory')->table('ip')->updateOrInsert(
                    ['id' => $integration->id],
                    [
                        'ip1' => (int)$parts[0],
                        'ip2' => (int)$parts[1],
                        'ip3' => (int)$parts[2],
                        'ip4' => (int)$parts[3]
                    ]
                );
            }
        }

        // Validar la solicitud
        $request->validate($rules);

        // Encontrar la integración existente
        $integration = Elemento::findOrFail($integration->id);

        // Actualizar la integración con los datos filtrados
        $integration->update($data);

        return redirect()->route('admin.integration.index')->with('success', __('messages.element_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $integrationId = decrypt($id);

        $integration = Elemento::findOrFail($integrationId);

        $integration->estado = 0;
        $integration->estat_integracio = 6;
        $integration->save();

        return redirect()->route('admin.integration.index')->with('success', __('messages.element_disabled'));
    }

    /**
     * Calculate the gateway IP address based on the given IP and subnet mask.
     */
    public function calculateGateway($ip, $mask)
    {
        // Validate and separate the parts of the IP address
        $ipParts = explode('.', $ip);
        if (count($ipParts) !== 4) {
            throw new \Exception('IP address is not valid.');
        }

        // Validate and separate the parts of the subnet mask
        $maskParts = explode('.', $mask);
        if (count($maskParts) !== 4) {
            throw new \Exception('Subnet mask is not valid.');
        }

        $networkParts = [];
        for ($i = 0; $i < 4; $i++) {
            $networkParts[] = intval($ipParts[$i]) & intval($maskParts[$i]);
        }

        // Increment the last part of the network address to get the gateway address
        $networkParts[3] += 1;

        // Combine the parts of the gateway address and return it
        $gateway = implode('.', $networkParts);

        return $gateway;
    }
}
