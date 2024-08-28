<?php

namespace App\Integrations;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BrevoConnector
{
    public PendingRequest $request;

    public function __construct()
    {
        $this->request = Http::baseUrl(url: config('services.brevo.url'))->timeout(seconds: 60);
    }

    /**
     * @throws \JsonException
     */
    public function send(string $body, string $to, string $subject): Response
    {
        $data = [
            'sender' => [
                'name' => 'YoTech',
                'email' => config('services.brevo.sender'),
            ],
            'to' => [
                [
                    'name' => 'Customer',
                    'email' => $to,
                ],
            ],
            'htmlContent' => $body,
            'subject' => $subject,
        ];

        $headers = [
            'Date' => now()->format('D, d M Y H:i:s \G\M\T'),
            'accept' => 'application/json',
            'api-key' => config('services.brevo.api_key'),
            'content-type' => 'application/json',
        ];

        return $this->request
            ->withHeaders($headers)
            ->withBody(json_encode($data, JSON_THROW_ON_ERROR), 'application/json')
            ->post(url: 'smtp/email');
    }
}
