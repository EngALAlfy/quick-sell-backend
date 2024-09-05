<?php

namespace App\Services;

use Illuminate\Http\Request;
use UAParser\Exception\FileNotFoundException;
use UAParser\Parser;

class UsersService
{

    public function createCustomer()
    {

    }

    /**
     * Log data of login operation
     * @throws FileNotFoundException
     */
    public function recordLoginData(Request $request): void
    {
        $os = null;
        $userAgent = null;

        try {
            $agent = Parser::create()->parse($request->userAgent());
            $os = $agent->os->toString();
            $userAgent = $agent->toString();
        } catch (\Exception $e) {
            // todo - error log and dev log
        }

        optional(auth()->user())->update([
            "last_login_ip" => getIp(),
            "last_login_useragent" => $userAgent,
            "last_login_datetime" => now(),
            "last_login_os" => $os
        ]);
    }
}
