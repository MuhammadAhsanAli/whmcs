<?php
namespace App\Http\Controllers;

use App\Services\CRMService;
use App\Services\ResponseService;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\ServiceOperationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{

    /**
     * Service instance for interacting with the CRM system.
     *
     * @var CRMService
     */
    protected CRMService $CRMService;

    /**
     * Service instance for handling HTTP responses.
     *
     * @var ResponseService
     */
    protected ResponseService $responseService;

    /**
     * ServiceController constructor.
     *
     * @param CRMService $CRMService
     * @param ResponseService $responseService
     */
    public function __construct(CRMService $CRMService, ResponseService $responseService)
    {
        $this->CRMService = $CRMService;
        $this->responseService = $responseService;
    }

    /**
     * Show the list of services.
     *
     * @return View
     */
    public function index(): View
    {
        //Dummy data to show the raws in table
        $services = [
            [
                'id' => 1,
                'storage' => 100,
                'bandwidth' => 500,
                'service_type' => 'Shared Hosting',
                'billing_cycle' => 'Monthly',
                'ip_address' => '192.168.1.1',
                'description' => 'Basic shared hosting plan',
            ],
            [
                'id' => 2,
                'storage' => 250,
                'bandwidth' => 1000,
                'service_type' => 'VPS Hosting',
                'billing_cycle' => 'Yearly',
                'ip_address' => '10.0.0.1',
                'description' => 'High-performance virtual private server',
            ],
            [
                'id' => 3,
                'storage' => 500,
                'bandwidth' => 2000,
                'service_type' => 'Dedicated Server',
                'billing_cycle' => 'Quarterly',
                'ip_address' => '172.16.0.1',
                'description' => 'Exclusive dedicated server for enterprise applications',
            ],
            [
                'id' => 4,
                'storage' => 50,
                'bandwidth' => 500,
                'service_type' => 'Cloud Storage',
                'billing_cycle' => 'Monthly',
                'ip_address' => '198.51.100.1',
                'description' => 'Scalable cloud storage solution',
            ],
            [
                'id' => 5,
                'storage' => 200,
                'bandwidth' => 1000,
                'service_type' => 'Email Hosting',
                'billing_cycle' => 'Monthly',
                'ip_address' => '203.0.113.1',
                'description' => 'Professional email hosting service',
            ],
        ];

        return view('admin.provisioning.list', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     *
     * @return View
     */
    public function showCreateForm(): View
    {
        return view('admin.provisioning.create');
    }

    /**
     * Create a new service.
     *
     * @param CreateServiceRequest $request
     * @return RedirectResponse
     */
    public function createService(CreateServiceRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $response = $this->CRMService->createService($validated);
        return $this->responseService->handle($response, 'Service created successfully.', 'services.index');
    }

    /**
     * Suspend a service.
     *
     * @param ServiceOperationRequest $request
     * @return RedirectResponse
     */
    public function suspendService(ServiceOperationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $response = $this->CRMService->suspendService($validated['service_id']);
        return $this->responseService->handle($response, 'Service suspended successfully.', 'services.index');
    }

    /**
     * Terminate a service.
     *
     * @param ServiceOperationRequest $request
     * @return RedirectResponse
     */
    public function terminateService(ServiceOperationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $response = $this->CRMService->terminateService($validated['service_id']);
        return $this->responseService->handle($response, 'Service terminated successfully.', 'services.index');
    }
}
