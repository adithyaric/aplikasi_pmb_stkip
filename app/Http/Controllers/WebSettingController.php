<?php

namespace App\Http\Controllers;

use App\Models\WebSetting;
use Illuminate\Http\Request;

class WebSettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index', [
            'setting' => WebSetting::first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_aktif' => 'required|string',
            'photo_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
            'photo_login' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $existingSetting = WebSetting::find($request->id);
        $photoFrontPath = $existingSetting?->photo_front ?? null;
        $photoLoginPath = $existingSetting?->photo_login ?? null;

        if ($request->hasFile('photo_front')) {
            $photoFrontPath = $request->file('photo_front')->store('web_setting', 'public');
        }

        if ($request->hasFile('photo_login')) {
            $photoLoginPath = $request->file('photo_login')->store('web_setting', 'public');
        }

        WebSetting::updateOrCreate(
            ['id' => $request->id],
            [
                'tahun_aktif' => $request->tahun_aktif,
                'photo_front' => $photoFrontPath,
                'photo_login' => $photoLoginPath,
            ]
        );

        return redirect()->route('admin.setting.index')->with('success', 'Data berhasil disimpan');
    }
}
