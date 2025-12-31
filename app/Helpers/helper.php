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

if (! function_exists('json_to_array')) {
    function json_to_array($data){
        if (is_array($data)) {
            return $data;
        }
        if (is_string($data)) {
            $decoded = json_decode($data, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
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

if (!function_exists('content_status_badge')) {
    function content_status_badge($status = null): array
    {
        return match ($status) {
            'published' => ['bg-success-gradient', 'PUBLISHED'],
            'scheduled' => ['bg-primary-gradient', 'SCHEDULED'],
            'draft'     => ['bg-dark-gradient', 'DRAFT'],
            'hidden'    => ['bg-secondary-gradient', 'HIDDEN'],
            'pending'   => ['bg-warning-gradient text-dark', 'PENDING'],
            default     => ['bg-secondary-gradient', strtoupper($status ?? 'UNKNOWN')],
        };
    }
}

if (!function_exists('badge_list')) {
    function badge_list($items, string $class)
    {
        if (empty($items)) {
            return '<span class="text-muted small">(empty)</span>';
        }

        return collect($items)->map(
            fn($i) =>
            "<span class=\"badge {$class} me-1\">{$i}</span>"
        )->implode('');
    }
}
