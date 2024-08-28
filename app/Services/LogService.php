<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Throwable;

class LogService
{
    /**
     * @param $code
     * @param Throwable $exception
     * @param $message
     * @param $functionName
     * @param $className
     * @return void
     */
    public static function error($code, Throwable $exception, $message = null, $functionName = null, $className = null): void
    {
        $logMessage =
            "
            Developer Code : $code \n
            Function Name : $functionName \n
            Class Name : $className \n
            Developer Message : $message \n
            Exception Message : {$exception->getMessage()} \n
            Exception Code : {$exception->getCode()} \n
            Exception Line : {$exception->getLine()} \n
            Exception File : {$exception->getFile()} \n
            Exception Trace : {$exception->getTraceAsString()} \n
            ";

        Log::error($logMessage);
    }
}
