<?php

namespace App\Http\Controllers;

use App\Models\vCenterVM;
use Illuminate\Http\Request;
use App\Services\vCenterService;
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
            $vms = vCenterVM::all();
            
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

    public function vms() {
        $vms = vCenterVM::select('id','name','description','annotation','guest_OS','hardware_version','upgrade_status','last_reboot')
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
