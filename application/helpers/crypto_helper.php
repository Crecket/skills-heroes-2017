<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('randomInt')) {
    function randomInt($min, $max)
    {
        if ($max <= $min) {
            throw new \Exception('Minimum equal or greater than maximum!');
        }
        if ($max < 0 || $min < 0) {
            throw new \Exception('Only positive integers supported for now!');
        }
        $difference = $max - $min;
        for ($power = 8; \pow(2, $power) < $difference; $power = $power * 2) ;
        $powerExp = $power / 8;

        do {
            $randDiff = \hexdec(\bin2hex(pseudoBytes($powerExp)));
        } while ($randDiff > $difference);
        return $min + $randDiff;
    }
}
if (!function_exists('pseudoBytes')) {
    function pseudoBytes($length = 1)
    {
        $bytes = \openssl_random_pseudo_bytes($length, $strong);
        if ($strong === TRUE) {
            return $bytes;
        } else {
            throw new \Exception ('Insecure server! (OpenSSL Random byte generation insecure.)');
        }
    }
}

// alternative hash/verify functions which prevent issues with null bytes on long passwords
if (!function_exists('password_hash_alt')) {
    function password_hash_alt($password)
    {
        return password_hash(base64_encode(hash('sha256', $password, true)), PASSWORD_DEFAULT);
    }
}

if (!function_exists('password_verify_alt')) {
    function password_verify_alt($password, $hash)
    {
        return password_verify(base64_encode(hash('sha256', $password, true)), $hash);
    }
}