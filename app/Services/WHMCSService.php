<?php

namespace App\Services;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class WHMCSService
{
    /**
     * HTTP service instance for making API requests.
     *
     * @var HttpService
     */
    protected HttpService $httpService;

    /**
     * API identifier for WHMCS authentication.
     *
     * @var string
     */
    protected $apiIdentifier;

    /**
     * API secret for WHMCS authentication.
     *
     * @var string
     */
    protected $apiSecret;

    /**
     * Limit of clients to fetch per request.
     */
    const CLIENTS_LIMIT = 25;

    /**
     * Create a new WHMCSService instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->httpService = new HttpService(config('services.remote_api.whm.base_url'));
        $this->apiIdentifier = config('services.remote_api.whm.identifier');
        $this->apiSecret = config('services.remote_api.whm.secret');
    }

    /**
     * Retrieve clients from WHMCS API.
     *
     * @return array Array of client data
     * @throws \Exception If request fails or unexpected response received
     */
    public function getClients(): array
    {
        $clients = [];
        $offset = 0;
        try {
            do {
                $result = $this->fetchClientsFromApi($offset);
                if (isset($result['client']) && is_array($result['client'])) {
                    $clients = array_merge($clients, $result['client']);
                    $offset += self::CLIENTS_LIMIT;
                } else {
                    break;
                }
            } while (count($result['client']) === self::CLIENTS_LIMIT);

            return $clients;
        } catch (RequestException $e) {
            $this->logErrorAndThrowException('WHMCS API request failed', $e);
        } catch (\Exception $e) {
            $this->logErrorAndThrowException('Failed to fetch clients from WHMCS', $e);
        }
    }

    /**
     * Fetch clients from WHMCS API with specified offset.
     *
     * @param int $offset
     * @return array
     * @throws RequestException
     */
    protected function fetchClientsFromApi(int $offset): array
    {
        $response = $this->httpService->post('', [
            'form_params' => [
                'action' => 'GetClients',
                'identifier' => $this->apiIdentifier,
                'secret' => $this->apiSecret,
                'limitnum' => self::CLIENTS_LIMIT,
                'limitstart' => $offset,
                'responsetype' => 'json'
            ]
        ]);

        if (!isset($response['response']['clients'])) {
            Log::error('Unexpected API response structure: clients key not found');
            throw new \Exception('Unexpected API response structure: clients key not found');
        }

        return $response['response']['clients'];
    }

    /**
     * Log error and throw an exception.
     *
     * @param string $message
     * @param \Exception $exception
     * @throws \Exception
     */
    protected function logErrorAndThrowException(string $message, \Exception $exception): void
    {
        Log::error($message . ': ' . $exception->getMessage());
        throw new \Exception($message);
    }
}
