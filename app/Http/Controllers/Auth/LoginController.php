<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\Redis\RedisService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function logout(RedisService $redisService): RedirectResponse
    {
        $user = Auth::user();
        $redisService->clearCode(session("phone"));
        Auth::logout();

        return redirect()->route("login");
    }

    public function login(LoginRequest $request, RedisService $redisService): RedirectResponse
    {
        $data = $request->validated();

        $codeSent = $redisService->getCode($data["phone"]);
        if ($codeSent !== null) {
            return redirect()->route("login")->with("error", "Code already sent, please wait");
        }
        $user = User::query()->where("phone", $data["phone"]);
        if ($user) {
            $this->putSession($data);
            $code = $redisService->generateAndStoreCode($data["phone"]);
//            $smsService = new TurboSmsService();
//            $smsService->sendSms($data['phone'], "Код авторизації:".$code);

            // redirect to verify page
            return redirect()->route("auth.verify");
        }

        return redirect()->route("auth.register")->with("error", "User not found");
    }

    private function putSession($data)
    {
        session("phone", $data["phone"]);
    }
}
