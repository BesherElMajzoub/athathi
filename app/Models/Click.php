<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $fillable = [
        'ip_hash',
        'button_id',
        'button_label',
        'page',
        'user_agent',
    ];

    /**
     * Record a click event from the request.
     */
    public static function track(string $buttonId, string $buttonLabel, string $page): self
    {
        $request = request();

        return self::create([
            'ip_hash'      => hash('sha256', $request->ip() . config('app.key')),
            'button_id'    => $buttonId,
            'button_label' => $buttonLabel,
            'page'         => $page,
            'user_agent'   => substr($request->userAgent() ?? '', 0, 500),
        ]);
    }
}
