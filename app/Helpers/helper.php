<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Vinkla\Hashids\Facades\Hashids;

use function PHPUnit\Framework\isNull;

if (!function_exists('route_details')) {
    function route_details($route)
    {
        $route = Route::getRoutes()->getByName($route);

        if ($route) {
            dd([
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'action' => $route->getActionName(),
                'middleware' => $route->middleware(),
            ]);
        }
    }
}

if (!function_exists('format_date')) {
    function format_date($date, $format = 'jS F Y', $blank = '-')
    {
        if (empty($date)) {
            return $blank;
        }

        try {
            return Carbon::parse($date)->format($format);
        } catch (DateException $err) {
            return  '-';
        }
    }
}

if (!function_exists('format_amount')) {
    function format_amount($amount, $decimals = 2, $currency = '$', $specialFormat = false)
    {
        if ($specialFormat) {
            if (intval($amount) == $amount) {
                $formatted = number_format((float)$amount, 0, '.', ',');
            } else {
                $formatted = number_format((float)$amount, $decimals, '.', ',');
            }
        } else {
            $formatted = number_format((float)$amount, $decimals, '.', ',');
        }

        return $currency . $formatted;
    }
}

if (!function_exists('format_amount_without_commas')) {
    function format_amount_without_commas($amount)
    {
        if (intval($amount) == $amount) {
            $formatted = number_format((float)$amount, 0, '.', '');
        } else {
            $formatted = number_format((float)$amount, 2, '.', '');
        }
        return $formatted;
    }
}

if (! function_exists('jsonToArray')) {
    function json_to_array($data)
    {
        $starsArray = json_decode($data, true);
        if (!is_array($starsArray)) {
            return [];
        }
        return array_map(function ($star) {
            return $star['value'] ?? null;
        }, $starsArray);
    }
}

if (! function_exists('hash_encode')) {
    function hash_encode($id)
    {
        return Hashids::encode($id);
    }
}

if (! function_exists('hash_decode')) {
    function hash_decode($hash)
    {
        $decoded = Hashids::decode($hash);
        return $decoded[0] ?? null;
    }
}

if (! function_exists('setLengthLimit')) {
    function setLengthLimit($str, $len, $ifNull = '--')
    {
        if (is_null($str) || $str === '') {
            return $ifNull;
        }
        if (strlen($str) <= $len + 3) {
            return $str;
        }
        return substr($str, 0, $len) . '...';
    }
}
