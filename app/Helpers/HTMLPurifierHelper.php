<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class HTMLPurifierHelper
{
    public static function clean($value)
    {
        Log::info('HTMLPurifierHelper::clean executed.');
        return strip_tags($value);
    }
}
