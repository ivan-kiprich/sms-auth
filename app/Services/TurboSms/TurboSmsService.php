<?php

namespace App\Services\TurboSms;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TurboSmsService
{
    private Client $client;
    protected string $url;
    protected string $token;

    public function __construct()
    {
        $this->token  = "Basic 4f715d34db317e535d364fdf34128937c72b4bc9";
        $this->url    = "https://api.turbosms.ua/message/send.json";
        $this->client = new Client();
    }


    public function sendSms($phone, $message): string
    {
        try {
            $response = $this->client->post($this->url, [
                "headers"     => [
                    "Content-Type"  => "application/x-www-form-urlencoded;",
                    "Authorization" => $this->token
                ],
                "form_params" => $this->arrayParams($phone, $message)
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $requestException) {
            return $requestException->getMessage();
        }
    }

    private function arrayParams($phone, $message): array
    {
        return [
            'recipients' => [$phone],
            'sms'        => [
                'sender' => 'KeepRich',
                'text'   => $message
            ],
        ];
    }
}
