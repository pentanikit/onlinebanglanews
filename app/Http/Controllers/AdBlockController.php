<?php

namespace App\Http\Controllers;

use App\Models\AdBlock;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class AdBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate basic structure
        $validated = $request->validate([
            'position_key'      => 'nullable|string|max:191',
            'ads'               => 'required|array',
            'ads.*.image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'ads.*.url'         => 'nullable|string|max:255',
        ]);

        // Default position if not sent from form
        $positionKey = $validated['position_key'] ?? 'home_sidebar';

        // We have blocks 1–6
        foreach (range(1, 6) as $slot) {
            $adInput = $validated['ads'][$slot] ?? [];

            // Old record (if exists)
            $existing = AdBlock::where('position_key', $positionKey)
                ->where('slot', $slot)
                ->first();

            $imagePath = $existing?->image; // keep old path if new not uploaded
            $url       = $adInput['url'] ?? $existing?->url;

            // If new image uploaded for this slot
            if ($request->hasFile("ads.$slot.image")) {
                $file = $request->file("ads.$slot.image");

                // Delete old image if exists
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Store new image in storage/app/public/ads
                $imagePath = $file->store('ads', 'public');
            }

            // If no image + no url + no existing record → nothing to save for this slot
            if (!$existing && !$imagePath && empty($url)) {
                continue;
            }

            // Create or update the ad block
            AdBlock::updateOrCreate(
                [
                    'position_key' => $positionKey,
                    'slot'         => $slot,
                ],
                [
                    'title'     => "Ad Block $slot",
                    'image'     => $imagePath,
                    'url'       => $url,
                    'is_active' => !empty($imagePath), // active only if image exists
                ]
            );
        }

        return redirect()
            ->back()
            ->with('success', 'Ad blocks updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdBlock $adBlock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdBlock $adBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdBlock $adBlock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdBlock $adBlock)
    {
        //
    }
}
