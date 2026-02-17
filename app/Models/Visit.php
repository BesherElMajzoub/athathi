<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'ip_hash',
        'user_agent',
        'referrer',
        'page',
        'country',
        'device_type',
    ];

    /**
     * Create a visit record from the current request.
     */
    public static function track(): self
    {
        $request = request();
        $userAgent = $request->userAgent() ?? '';

        return self::create([
            'ip_hash'     => hash('sha256', $request->ip() . config('app.key')),
            'user_agent'  => substr($userAgent, 0, 500),
            'referrer'    => substr($request->header('referer', ''), 0, 500),
            'page'        => substr($request->path(), 0, 500),
            'device_type' => self::detectDevice($userAgent),
        ]);
    }

    /**
     * Basic device type detection.
     */
    protected static function detectDevice(string $ua): string
    {
        $ua = strtolower($ua);
        if (str_contains($ua, 'mobile') || str_contains($ua, 'android')) {
            return 'mobile';
        }
        if (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            return 'tablet';
        }
        return 'desktop';
    }
}
