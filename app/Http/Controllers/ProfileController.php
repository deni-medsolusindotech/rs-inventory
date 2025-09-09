<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Konfirmasi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{   

    public function index(){
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin')){
            return redirect('/dashboard');
        }
        return view('profile.index');
    }

 
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
        $fileName = 'avatar-'.auth()->user()->id; // Nama file yang ingin dicek
        $directory = 'profile'; // Direktori tempat file disimpan di dalam disk 'dokumen'
        // Proses Hapus gambar dulu
            // Mendapatkan semua file dalam direktori
            $files = Storage::disk('dokumen')->files($directory);

            foreach ($files as $file) {
                // Mengekstrak nama file dan ekstensi
                $pathinfo = pathinfo($file);
                $file_name = $pathinfo['filename'];

                // Memeriksa jika nama file sama
                if ($file_name === $fileName) {
                    // Menghapus file
                    Storage::disk('dokumen')->delete($file);
                }
            }
        // Upload Gambar
        $avatar = $request->profile_image->storeAs($directory,$fileName.'.'.$request->profile_image->extension(),'dokumen');
        
        $request->user()->fill([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatar,
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect('/dashboard')->with('success', 'Profile Berhasil Di Edit');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
