<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        $donations = $user->donations()
            ->with('campaign')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        return view('pages.profile', compact('user', 'donations'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('pages.profile_edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birth_place' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:10',
        ]);

        $user = Auth::user();
        $user->update($request->only([
            'name', 'phone', 'birth_place', 'birth_date', 'gender',
            'address', 'city', 'province', 'country', 'zip_code'
        ]));

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function uploadKyc(Request $request)
    {
        $request->validate([
            'ktp_number' => 'required|string|size:16',
            'ktp_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'selfie_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = Auth::user();

        if ($request->hasFile('ktp_photo')) {
            if ($user->ktp_photo) {
                Storage::disk('public')->delete($user->ktp_photo);
            }
            $ktpPath = $request->file('ktp_photo')->store('kyc/ktp', 'public');
            $user->ktp_photo = $ktpPath;
        }

        if ($request->hasFile('selfie_photo')) {
            if ($user->selfie_photo) {
                Storage::disk('public')->delete($user->selfie_photo);
            }
            $selfiePath = $request->file('selfie_photo')->store('kyc/selfie', 'public');
            $user->selfie_photo = $selfiePath;
        }

        $user->ktp_number = $request->ktp_number;
        $user->kyc_status = 'pending';
        $user->save();

        return redirect()->route('profile')->with('success', 'Dokumen KYC berhasil diupload! Menunggu verifikasi admin.');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui!');
    }
}
