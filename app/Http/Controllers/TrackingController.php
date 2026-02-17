<?php

namespace App\Http\Controllers;

use App\Models\Click;
use App\Models\Visit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Track a click event via AJAX.
     */
    public function trackClick(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'button_id' => 'required|string|max:100',
            'button_label' => 'nullable|string|max:200',
            'page' => 'required|string|max:500',
        ]);

        try {
            Click::track(
                $validated['button_id'],
                $validated['button_label'] ?? '',
                $validated['page']
            );

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['status' => 'error'], 500);
        }
    }
}
