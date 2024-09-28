<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Operations 
{
    // Dessa maneira, qualquer controller poderá chamar esse método
    // São classificado como services
    public static function decrypt($value)
    {
        try {
            $value = Crypt::decrypt($value);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return $value;
    }
}