<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    protected string $token;
    protected ?string $from;

    public function __construct()
    {
        $this->token = config('services.smsapi.token');
        $this->from = config('services.smsapi.from');
    }

    public function send(string $phone, string $message): bool
    {
        try {
            $request = Http::withToken($this->token)
                ->asForm();

            if (app()->environment('local')) {
                $request->withOptions(['verify' => false]);
            }

            $payload = [
                'to'       => $phone,
                'message'  => $message,
                'encoding' => 'utf-8',
            ];

            if (!empty($this->from)) {
                $payload['from'] = $this->from;
            }

            $response = $request->post('https://api.smsapi.pl/sms.do', $payload);

            return $response->successful();
        } catch (\Exception $e) {
            logger()->error('Błąd wysyłki SMS: ' . $e->getMessage());
            return false;
        }
    }
}
