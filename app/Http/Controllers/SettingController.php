<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

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
}
