<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Redis\RedisService;
use Illuminate\Http\RedirectResponse;

class RegistrerController extends Controller
{
    //
    public function create(RegisterRequest $request, RedisService $redisService): RedirectResponse
    {
        $data = $request->validated();

        $user = User::query()->where("phone", $data["phone"])->first();
        if ($user) {
            // redirect to login page
            return redirect()->route("auth.login")->with('error', 'User already exists');
        }

        $this->putSession($data);
        $code = $redisService->generateAndStoreCode($data["phone"]);
//        $smsService = new TurboSmsService();
//        $smsService->sendSms($data['phone'], "Код авторизації:".$code);

        // redirect to verify page
        return redirect()->route("auth.verify");
    }

    private function putSession(array $data): void
    {
        session()->put('name', $data["name"]);
        session()->put('phone', $data["phone"]);
    }

}
