<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'storage' => 'required|numeric',
            'bandwidth' => 'required|numeric',
            'service_type' => 'required|string',
            'billing_cycle' => 'required|string',
            'ip_address' => 'nullable|ip',
            'description' => 'nullable|string',
            'auto_renewal' => 'nullable|boolean',
            'email_notifications' => 'nullable|boolean',
        ];
    }
}
