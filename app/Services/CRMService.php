<?php

namespace App\Services;

class CRMService
{
    /**
     * HTTP service instance for making API requests.
     *
     * @var HttpService
     */
    protected HttpService $httpService;

    /**
     * CRMService constructor.
     */
    public function __construct()
    {
        $this->httpService = new HttpService(config('services.remote_api.crm'));
    }

    /**
     * Create a new service.
     *
     * @param array $data
     * @return array
     */
    public function createService(array $data): array
    {
        return $this->httpService->post('/services', $data);
    }

    /**
     * Suspend a service.
     *
     * @param int $serviceId
     * @return array
     */
    public function suspendService(int $serviceId): array
    {
        return $this->httpService->put("/services/{$serviceId}", ['status' => 'suspended']);
    }

    /**
     * Terminate a service.
     *
     * @param int $serviceId
     * @return array
     */
    public function terminateService(int $serviceId): array
    {
        return $this->httpService->delete("/services/{$serviceId}");
    }

    /**
     * Update client information.
     *
     * @param array $data
     * @return array
     */
    public function updateClient(array $data): array
    {
        return $this->httpService->post('/clients/update', $data);
    }
}
