<?php

namespace App\Services;

class DataTransformer
{
    /**
     * Transform client data into a standardized format.
     *
     * @param array $clientData The original client data array
     * @return array The transformed client data array
     */
    public function transformClientData(array $clientData): array
    {
        return [
            'client_id' => $clientData['id'],
            'client_name' => $clientData['firstname'] . ' ' . $clientData['lastname'],
            'client_company_name' => $clientData['companyname'],
            'client_email' => $clientData['email'],
            'client_created_date' => $clientData['datecreated'],
            'client_group_id' => $clientData['groupid'],
            'client_status' => $clientData['status'],
        ];
    }
}
