<?php

namespace App\Services;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class ResponseService
{
    /**
     * Handle the API response.
     *
     * @param array $response
     * @param string $successMessage
     * @param string $redirectRoute
     * @return RedirectResponse
     */
    public function handle(array $response, string $successMessage, string $redirectRoute): RedirectResponse
    {
        if (isset($response['error'])) {
            Log::error('API Error', ['response' => $response]);
            session()->flash('error', $response['message'] ?? 'An error occurred.');
            return back()->withInput();
        } else {
            return redirect()->route($redirectRoute)->with('status', $successMessage);
        }
    }
}
