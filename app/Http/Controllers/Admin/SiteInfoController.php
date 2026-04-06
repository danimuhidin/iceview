<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteInfoController extends Controller
{
    public function edit()
    {
        $siteInfo = SiteInfo::query()->firstOrCreate([], [
            'brand_name' => 'Iceview',
            'footer_text' => 'All Right reserved',
        ]);

        return view('admin.site-info.edit', compact('siteInfo'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'brand_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'footer_text' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'link_maps' => ['nullable', 'url', 'max:255'],
            'office_hour' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:100'],
            'instagram_link' => ['nullable', 'url', 'max:255'],
            'tiktok_link' => ['nullable', 'url', 'max:255'],
            'facebook_link' => ['nullable', 'url', 'max:255'],
            'youtube_link' => ['nullable', 'url', 'max:255'],
            'marketplace_link' => ['nullable', 'url', 'max:255'],
            'terms_conditions' => ['nullable', 'string'],
            'privacy_policy' => ['nullable', 'string'],
            'dealer_terms' => ['nullable', 'string'],
            'brand_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $siteInfo = SiteInfo::query()->firstOrCreate([], [
            'brand_name' => 'Iceview',
            'footer_text' => 'All Right reserved',
        ]);

        if ($request->hasFile('brand_image')) {
            if ($siteInfo->brand_image) {
                Storage::disk('public')->delete($siteInfo->brand_image);
            }

            $validated['brand_image'] = $request->file('brand_image')->store('site-info', 'public');
        }

        $siteInfo->update($validated);

        return back()->with('status', 'Informasi website berhasil diperbarui.');
    }
}
