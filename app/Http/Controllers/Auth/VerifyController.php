<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Redis\RedisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{
    //
    public function verifyCode(Request $request, RedisService $redisService)
    {
        $phone = session("phone");
        $name  = session("name");
        $code  = $request->get("code");
        // 1 check if code exists
        if ($redisService->checkCode($phone, $code)) {
            $user = User::query()->where("phone", $phone)->first();
            if ( ! $user) {
                $user = User::create([
                    "name"  => $name,
                    "phone" => $phone,
                ]);
            }
            Auth::login($user);

            return redirect()->route("dashboard");
        } else {
            return redirect()->route("auth.verify")->with("error", "Код не вірний, спробуйте знову");
        }
    }
}
