<?php

namespace App\Http\Controllers;

use App\Models\vCenterVM;
use Illuminate\Http\Request;
use App\Services\vCenterService;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Yajra\DataTables\Facades\DataTables;

class VCenterController extends Controller
{
    protected $vCenterService;

    public function __construct(vCenterService $vCenterService)
    {
        $this->vCenterService = $vCenterService;

        $this->middleware('can:admin.vms.index')->only('index','vms','clearUpgradeStatus');
        $this->middleware('can:admin.vms.edit')->only('update');
    }

    /**
     * Show the list of VMs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            //$this->vcenterService->fetchAndStoreVMs(); // Fetch and store VMs data
            $vms = vCenterVM::all(); // Retrieve data from the database
            
            return view('admin.vcenter_vms.index', compact('vms'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        $vmId = $request->input('id');
        $column = $request->input('column');
        $value = $request->input('value');
    
        // Actualiza la VM en la base de datos
        $vm = vCenterVM::find($vmId);
        $vm->$column = $value;
        $vm->save();
    
        // Devuelve la VM actualizada en la respuesta
        return response()->json([
            'success' => true,
            'updated_vm' => $vm
        ]);
    }
    // {
    //     $vm = vCenterVM::findOrFail($request->id);
    //     $column = $request->column;
    //     $value = $request->value;

    //     if (in_array($column, ['id', 'name', 'power_state', 'guest_OS', 'hardware_version', 'tools_version_status', 'upgrade_status'])) {
    //         $vm->$column = $value;
    //         $vm->save();

    //         return response()->json(['success' => true]);
    //     }

    //     return response()->json(['success' => false], 400);
    //     // $vmId = $request->input('id');
    //     // $column = $request->input('column');
    //     // $value = $request->input('value');

    //     // $vm = vCenterVM::find($vmId);
    //     // if ($vm) {
    //     //     $vm->$column = $value;
    //     //     $vm->save();

    //     //     return response()->json(['success' => true]);
    //     // }

    //     // return response()->json(['success' => false], 404);
    // }

    public function vms() {
        $vms = vCenterVM::select('id','name','power_state','guest_OS','tools_version_status','hardware_version','upgrade_status')
        ->where(function ($query) {
            $query->whereNull('upgrade_status')
                ->orWhere('upgrade_status', '!=', 'NO');
        })
        ->get();


        return Datatables::collection($vms)->toJson();
    }

    public function clearUpgradeStatus(Request $request)
    {
        try {
            vCenterVM::where('upgrade_status', '!=', 'NO')->update(['upgrade_status' => null]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
