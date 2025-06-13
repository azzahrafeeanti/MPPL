<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;



class AuthController extends Controller
{
    //
    public function signUp() {
        return view('landing.signUp');
    }

    public function signIn() {
        return view('landing.signIn');
    }

    public function handleSignUp(Request $request){
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        // Simpan user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Login user
        Auth::login($user);
        return redirect()->route('landing.index');

        dd($request->all());

    }

    public function handleSignIn(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('landing.index'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function editProfil()
    {
        // Pastikan pengguna login
        if (!Auth::check()) {
            return redirect()->route('landing.signIn');
        }

        return view('landing.editProfil');
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());

        // Pastikan pengguna login
        if (!Auth::check()) {
            return redirect()->route('landing.signIn');
        }

        $user = Auth::user();

        // Ensure $user is an instance of App\Models\User
        if (!($user instanceof \App\Models\User)) {
            $user = \App\Models\User::find($user->id);
        }

        // Validasi data input
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Pastikan email unik, kecuali jika itu adalah email user yang sedang diupdate
                Rule::unique('users')->ignore($user->id),
            ],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // Max 2MB, hanya gambar
        ]);

        // Update nama dan email
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            // Simpan foto baru
            $user->profile_photo = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('landing.editProfil')->with('success', 'Profil berhasil diperbarui!');
    }
}
