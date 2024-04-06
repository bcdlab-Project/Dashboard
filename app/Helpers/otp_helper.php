<?php

require APPPATH.'ThirdParty/base32.php';

/**
 * @param string $sercet_key A string of the secret key.
 * @param int $time_step Time to use for the OTP code, defaults to 60 seconds.
 * @param int $length Length of the OTP code, defaults to 6.
 * @return string
*/

function generateOTP(string $secret_key, int $time_step = 30, int $length = 6): string {
    $secret_key = Base32::decode($secret_key);
    $counter = floor(time() / $time_step);
    $data = pack("NN", 0, $counter);
    $hash = hash_hmac('sha1', $data, $secret_key, true);
    $offset = ord(substr($hash, -1)) & 0x0F;
    $value = unpack("N", substr($hash, $offset, 4));
    $otp = ($value[1] & 0x7FFFFFFF) % pow(10, $length);

    return str_pad(strval($otp), $length, '0', STR_PAD_LEFT);
}

function GenerateSecret($length = 16) {
    if ($length % 8 != 0) {
        throw new \Exception("Length must be a multiple of 8");
    }

    $secret = openssl_random_pseudo_bytes($length, $strong);
    if (!$strong) {
        throw new \Exception("Random string generation was not strong");
    }

    return Base32::encode($secret);
}