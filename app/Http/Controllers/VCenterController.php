<?php

namespace App\Http\Controllers;

use App\Models\vCenterVM;
use Illuminate\Http\Request;
use App\Services\vCenterService;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class VCenterController extends Controller
{
    protected $vCenterService;

    public function __construct(vCenterService $vCenterService)
    {
        $this->vCenterService = $vCenterService;
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
}
