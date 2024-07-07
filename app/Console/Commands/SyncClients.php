<?php

namespace App\Console\Commands;

use App\Services\CRMService;
use App\Services\DataTransformer;
use App\Services\WHMCSService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncClients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'whmcs:sync-clients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize client data from WHMCS to CRM';

    /**
     * WHMCS Service instance.
     *
     * @var WHMCSService
     */
    protected WHMCSService $whmcsService;

    /**
     * DataTransformer instance.
     *
     * @var DataTransformer
     */
    protected DataTransformer $dataTransformer;

    /**
     * CRM Service instance.
     *
     * @var CRMService
     */
    protected CRMService $crmService;

    /**
     * Create a new command instance.
     *
     * @param WHMCSService $whmcsService
     * @param DataTransformer $dataTransformer
     * @param CRMService $crmService
     */
    public function __construct(WHMCSService $whmcsService, DataTransformer $dataTransformer, CRMService $crmService)
    {
        parent::__construct();

        $this->whmcsService = $whmcsService;
        $this->dataTransformer = $dataTransformer;
        $this->crmService = $crmService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $clients = $this->whmcsService->getClients();

            if (empty($clients)) {
                $this->error('No clients found from WHMCS.');
                return;
            }

            $transformedData = array_map([$this->dataTransformer, 'transformClientData'], $clients);

            $response = $this->crmService->updateClient($transformedData);

            if ($response['status_code'] === 200) {
                $this->info('Client data synchronized successfully.');
            } else {
                $this->error('Failed to update client data in CRM. Status code: ' . $response['status_code']);
            }
        } catch (\Exception $e) {
            Log::error('Error syncing clients: ' . $e->getMessage());
            $this->error('An error occurred while synchronizing client data.');
        }
    }
}
