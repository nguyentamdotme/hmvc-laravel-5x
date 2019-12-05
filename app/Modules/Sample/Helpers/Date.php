<?php
namespace App\Helpers;

use Request;
use Illuminate\Support\Facades\Log;

class Date {
    public static function get() {
        return Date("d/m/Y H:i:s");
    }
}