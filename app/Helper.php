<?php

use App\Models\User;

if (!function_exists('uploadFile')) {
    function uploadFile($file, $dir)
    {
        if ($file) {

            $destinationPath =  storage_path('app/public') . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR;

            $media_image = $file->hashName();

            $file->move($destinationPath, $media_image);

            return $media_image;
        }
    }
}

if (!function_exists('encryptString')) {
    function encryptString($plaintext)
    {
        $ciphertext_raw = openssl_encrypt(
            $plaintext,
            'AES-256-CBC',
            config('app.SERVER_ENCRYPTION_KEY'),
            $options = 0,
            config('app.SERVER_ENCRYPTION_IV')
        );
        return base64_encode($ciphertext_raw);
    }
}

if (!function_exists('decryptString')) {

    function decryptString($plaintext)
    {
        $c = base64_decode($plaintext);
        $original_plaintext = openssl_decrypt($c, 'AES-256-CBC', config('app.SERVER_ENCRYPTION_KEY'), $options = 0, config('app.SERVER_ENCRYPTION_IV'));
        return $original_plaintext;
    }
}


