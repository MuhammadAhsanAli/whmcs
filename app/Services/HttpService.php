<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class HttpService
{
    /**
     * HTTP client instance for making HTTP requests.
     *
     * @var Client
     */
    protected Client $client;

    /**
     * Base URL used for constructing full request URLs.
     *
     * @var string|null
     */
    protected ?string $baseUrl;

    /**
     * Constructs a new HttpService instance.
     *
     * @param string|null $baseUrl
     */
    public function __construct(string $baseUrl = null)
    {
        $this->client = new Client();
        $this->baseUrl = $baseUrl;
    }

    /**
     * Send a GET request.
     *
     * @param string $endpoint
     * @return array
     */
    public function get(string $endpoint): array
    {
        return $this->request('GET', $endpoint);
    }

    /**
     * Send a POST request.
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    public function post(string $endpoint, array $data): array
    {
        return $this->request('POST', $endpoint, ['form_params' => ['data' => $data]]);
    }

    /**
     * Send a PUT request.
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    public function put(string $endpoint, array $data): array
    {
        return $this->request('PUT', $endpoint, ['json' => $data]);
    }

    /**
     * Send a DELETE request.
     *
     * @param string $endpoint
     * @return array
     */
    public function delete(string $endpoint): array
    {
        return $this->request('DELETE', $endpoint);
    }

    /**
     * Make an HTTP request.
     *
     * @param string $method
     * @param string $endpoint
     * @param array $options
     * @return array
     */
    protected function request(string $method, string $endpoint, array $options = []): array
    {
        try {
            $response = $this->client->request($method, $this->buildUrl($endpoint), $options);
            return $this->handleResponse($response);
        } catch (RequestException $e) {
            Log::error('HTTP Request failed', ['exception' => $e]);
            return $this->handleException($e);
        }
    }

    /**
     * Build the full URL for the request.
     *
     * @param string $endpoint
     * @return string
     */
    protected function buildUrl(string $endpoint): string
    {
        return rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');
    }

    /**
     * Handle the HTTP response.
     *
     * @param ResponseInterface $response
     * @return array
     */
    protected function handleResponse(ResponseInterface $response): array
    {
        $body = json_decode($response->getBody(), true);
        return [
            'status_code' => $response->getStatusCode(),
            'response' => $body
        ];
    }

    /**
     * Handle request exceptions.
     *
     * @param RequestException $e
     * @return array
     */
    protected function handleException(RequestException $e): array
    {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $body = json_decode($response->getBody(), true);
            Log::error('HTTP Request failed', [
                'status_code' => $response->getStatusCode(),
                'body' => $body,
            ]);
            return [
                'error' => 'Request failed',
                'status_code' => $response->getStatusCode(),
                'message' => $body['message'] ?? 'Unknown error'
            ];
        } else {
            Log::error('HTTP Request failed', ['message' => $e->getMessage()]);
            return [
                'error' => 'Request failed',
                'message' => $e->getMessage()
            ];
        }
    }
}
