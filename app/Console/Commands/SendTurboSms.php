<?php

namespace App\Console\Commands;

use App\Services\TurboSms\TurboSmsService;
use Illuminate\Console\Command;

class SendTurboSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-turbo-sms';

    protected $description = 'Send turbo SMS';

    /**
     * Execute the console command.
     */
    public function handle(TurboSmsService $turboSmsService)
    {
        $phone   = "380667317286";
        $message = "test";
        $result  = $turboSmsService->sendSms($phone, $message);
        dd($result);
    }
}
