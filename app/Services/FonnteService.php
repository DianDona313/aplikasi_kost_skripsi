<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $client;
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'connect_timeout' => 10
        ]);
        $this->apiKey = env('FONNTE_API_KEY');
        $this->baseUrl = 'https://api.fonnte.com';
    }

    public function sendMessage($to, $message)
    {
        try {
            // Validate phone number format
            $to = $this->formatPhoneNumber($to);
            
            $response = $this->client->post($this->baseUrl . '/send', [
                'headers' => [
                    'Authorization' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'target' => $to,
                    'message' => $message,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            
            // Log the response for debugging
            Log::info('Fonnte API Response', [
                'to' => $to,
                'response' => $body
            ]);

            return $body;

        } catch (RequestException $e) {
            $errorMessage = 'HTTP Request failed';
            $errorData = [
                'to' => $to,
                'message' => $message,
                'error' => $e->getMessage()
            ];

            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                $errorData['response'] = $responseBody;
                
                if (isset($responseBody['reason'])) {
                    $errorMessage = $responseBody['reason'];
                }
            }

            Log::error('Fonnte API Error', $errorData);

            return [
                'status' => false,
                'reason' => $errorMessage,
                'details' => $errorData
            ];

        } catch (\Exception $e) {
            Log::error('Unexpected error in sendMessage', [
                'to' => $to,
                'error' => $e->getMessage()
            ]);

            return [
                'status' => false,
                'reason' => 'Unexpected error: ' . $e->getMessage()
            ];
        }
    }

    public function getDeviceStatus()
    {
        try {
            $response = $this->client->get($this->baseUrl . '/device', [
                'headers' => [
                    'Authorization' => $this->apiKey,
                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (RequestException $e) {
            $errorMessage = 'Failed to get device status';
            
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                if (isset($responseBody['reason'])) {
                    $errorMessage = $responseBody['reason'];
                }
            }

            throw new \Exception($errorMessage);
        }
    }

    protected function formatPhoneNumber($phoneNumber)
    {
        // Remove any non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phoneNumber);
        
        // Handle Indonesian phone numbers
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }

    public function validateApiKey()
    {
        try {
            $response = $this->getDeviceStatus();
            return isset($response['device']);
        } catch (\Exception $e) {
            return false;
        }
    }
}