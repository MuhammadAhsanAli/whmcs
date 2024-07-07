# WHMCS Custom Provisioning and CRM Integration

This project focuses on developing a robust solution leveraging WHMCS for custom provisioning and seamless CRM integration. The custom provisioning module enables the creation, suspension, and termination of services through a configurable interface, ensuring flexibility in managing storage space, bandwidth, and other service options. Additionally, the integration script synchronizes client data between WHMCS and an external CRM system, facilitating data retrieval, transformation, and synchronization via mock API endpoints. This project exemplifies system integration and service management within the WHMCS ecosystem.

## Getting Started

These instructions will guide you on setting up the project on your local machine for development and testing purposes. If you have setup the mock/WHMCS API endpoints, you can verify the results of your requests accordingly.

### Prerequisites

- PHP >= 8.2
- Composer
- MySQL

### Installing

1. Clone the repository:
 ```
https://github.com/MuhammadAhsanAli/whmcs.git
 ```

2. Install PHP dependencies:
 ```
composer update
 ```

3. Duplicate the `.env.example` file and rename it to `.env`. Configure your database credentials, HRM and WHMCS API URLs, along with their respective identifiers and secrets in the `.env` file.

4. Run the follwing command in root directory:
 ```
npm install && npm run dev
 ```
 
5. Set read and write permissions are set for the storage and bootstrap/cache folders:
 ```
sudo chmod -R 777 storage
 ```

6. Register by selecting the 'Register' button to create a user account.

Usage
-----

### Manage Provisiosning Service:

1. **Viewing Provisioning List:**
   - Display details such as ID, Storage (GB), Bandwidth (GB), Service Type, IP, with actions available to Suspend or Terminate the service.

2. **Create Provisioning Record:**
   - Fill in details for Service Type, Billing Cycle, Storage Space (GB), Bandwidth (GB), and optionally Enable Auto-Renewal, IP Address, Email Notifications, and Service Description.

3. **Suspend Service:**
   - Click the "Suspend" button in the list view to mark the account as suspended.

4. **Terminate Service:**
   - Click the "Terminate" button in the list view to terminate the account.

### WHMCS Client Data Synchronization:

1. **Fetch Clients:**
   - Execute the whmcs:sync-clients command to send a GET request to WHMCS using the GetClients action.

2. **Transform API Data:**
   - Transform the retrieved data and map it to align with the required CRM format.

3. **Update Clients in CRM:**
   - Push data via a POST request to CRM to update client data.

