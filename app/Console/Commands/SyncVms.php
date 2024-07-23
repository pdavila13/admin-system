<?php

namespace App\Console\Commands;

use App\Models\vCenterVM;
use Illuminate\Console\Command;
use App\Services\vCenterService;

class SyncVms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:vms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync VMs from vCenter';

    /**
     * The vCenter service.
     *
     * @var string
     */
    protected $vCenterService;

    /**
     * Create a new command instance.
     *
     * @param vCenterService $vCenterService
     */
    public function __construct(vCenterService $vcenterService)
    {
        parent::__construct();
        $this->vcenterService = $vcenterService;
    }
    /**
     * Execute the console command.
     */

    public function handle()
    {
        $this->info('Fetching VMs from vCenter...');

        try {
            $this->vcenterService->fetchAndStoreVMs();
            $this->info('VMs fetched and stored successfully.');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }

        return 0;
    }
}
