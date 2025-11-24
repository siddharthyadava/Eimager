<?php

namespace App\Http\Controllers\utils;


use Symfony\Component\Console\Output\ConsoleOutput;

class Utilities {

    // public static function checkAndIgnoreOtpVerification() {
    //     $ignore_otp_verification = env('APP_IGNORE_OTP_VERIFICATION');
    //     $output = new ConsoleOutput();
    //     $output->writeln('------------------- '. $ignore_otp_verification);
    //     return $ignore_otp_verification;
    // }
    public static function checkAndIgnoreOtpVerification() {
    // Read env with default false, then convert to boolean safely
    $val = env('APP_IGNORE_OTP_VERIFICATION', false);

    // Convert a variety of truthy strings to actual boolean true:
    // Accepts: true, "true", "1", 1, "yes", "on"
    $bool = filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    // If filter_var returned null (unknown), fall back to strict comparison
    if ($bool === null) {
        $bool = ($val === true || $val === 'true' || $val === '1');
    }

    return (bool) $bool;
}


}