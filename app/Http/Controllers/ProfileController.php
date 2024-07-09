<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Mengisi data yang divalidasi
        $validatedData = $request->validated();

        // Memeriksa apakah email telah diubah
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Menangani pengunggahan gambar profil
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            // Menghapus gambar profil lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            // Menyimpan gambar profil yang baru
            $avatar->storeAs('public/avatars', $avatar->hashName());
            $validatedData['avatar'] = $avatar->hashName();
        }

        // Mengisi data yang divalidasi ke dalam model user
        $user->fill($validatedData);

        // Menyimpan perubahan
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
