<?php

namespace App\Services\Redis;

use Illuminate\Support\Facades\Redis;

class RedisService
{
    public function generateAndStoreCode($phone): string
    {
        $code = $this->generateCode();
        Redis::set("key{$phone}:", $code);
        Redis::expire("key{$phone}:", 300);

        return $code;
    }

    public function getCode($phone): string|null
    {
        return Redis::get("key{$phone}:");
    }

    public function clearCode($phone)
    {
        Redis::del("key{$phone}:");
    }

    public function generateCode(): string
    {
        return rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
    }

    public function checkCode($phone, $code): bool
    {
        $savedCode = $this->getCode($phone);

        return $savedCode && $savedCode == $code;
    }
}
