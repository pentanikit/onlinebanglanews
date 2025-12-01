<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::orderBy('key')->get();

        if ($request->expectsJson()) {
            return response()->json($settings);
        }

        return view('settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        // handle multiple key => value save
        $data = $request->validate([
            'settings'             => 'required|array',
            'settings.*.key'       => 'required|string',
            'settings.*.value'     => 'nullable|string',
        ]);

        foreach ($data['settings'] as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                ['value' => $item['value'] ?? null]
            );
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('settings.index')->with('success', 'Settings saved.');
    }

    public function update(Request $request)
    {
        // যেসব ইনপুট আসবে সব নিয়েই কাজ করব
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // cache clear (আগে helper এ cache করলে)
        Cache::forget('settings_cache');

        return redirect()->back()->with('success', 'সেটিংস সফলভাবে আপডেট হয়েছে।');
    }
}
