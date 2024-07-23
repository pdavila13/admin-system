<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\vCenterVM;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class vCenterService
{
    protected $vcenterHost;
    protected $username;
    protected $password;
    protected $client;
    protected $data;

    public function __construct()
    {
        $this->vcenterHost = env('VCENTER_HOST');
        $this->username = env('VCENTER_USERNAME');
        $this->password = env('VCENTER_PASSWORD');

        $this->client = new Client([
            'base_uri' => $this->vcenterHost,
            'verify' => false,
        ]);
    }

    public function getAuthToken()
    {
        try {
            // Request a new session token from vCenter using the provided credentials
            $response = $this->client->post('/api/session', [
                'auth' => [$this->username, $this->password],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Obtain the content of the response
            $responseBody = $response->getBody()->getContents();

            // The content of the response is a JSON string with the token
            $token = trim($responseBody, '"');

            if (empty($token)) {
                throw new \Exception('Authentication token not found in response.');
            }

            return $token;
        } catch (RequestException $e) {
            throw new \Exception('Error authenticating to vCenter: ' . $e->getMessage());
        } catch (GuzzleException $e) {
            throw new \Exception('Guzzle HTTP error: ' . $e->getMessage());
        }
    }

    public function fetchAndStoreVMs()
    {
        try {
            $token = $this->getAuthToken();
            $response = $this->client->get('/api/vcenter/vm', [
                'headers' => [
                    'vmware-api-session-id' => $token,
                ],
            ]);

            $responseBody = $response->getBody()->getContents();
            $vms = json_decode($responseBody, true);

            if (is_array($vms) && !empty($vms)) {
                foreach ($vms as $vm) {
                    $vmId = $vm['vm'];
                    $detailedVM = $this->getVMDetails($vmId, $token);
                    $toolsDetails = $this->getVMToolsDetails($vmId, $token);

                    vCenterVM::updateOrCreate(
                        ['vm_id' => $vmId],
                        [
                            'name' => $detailedVM['name'],
                            'power_state' => $detailedVM['power_state'],
                            // 'creation_date' => $detailedVM['creation_date'] ?? null,
                            // 'annotation' => $detailedVM['annotation'] ?? null,
                            'guest_OS' => $detailedVM['guest_OS'] ?? null,
                            // 'criticality' => $detailedVM['criticality'] ?? null,
                            'hardware_version' => $detailedVM['hardware']['version'] ?? null,
                            'tools_version_status' => $toolsDetails['version_status'] ?? null,
                        ]
                    );
                }
            } else {
                throw new \Exception('VMs not found in response.');
            }
        } catch (RequestException $e) {
            throw new \Exception('Error fetching VMs from vCenter: ' . $e->getMessage());
        } catch (GuzzleException $e) {
            throw new \Exception('Guzzle HTTP error: ' . $e->getMessage());
        }
    }

    protected function getVMDetails($vmId, $token)
    {
        $response = $this->client->get("/api/vcenter/vm/{$vmId}", [
            'headers' => [
                'vmware-api-session-id' => $token,
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        return json_decode($responseBody, true);
    }

    protected function getVMToolsDetails($vmId, $token)
    {
        $response = $this->client->get("/api/vcenter/vm/{$vmId}/tools", [
            'headers' => [
                'vmware-api-session-id' => $token,
            ],
        ]);

        $responseBody = $response->getBody()->getContents();
        return json_decode($responseBody, true);
    }
}